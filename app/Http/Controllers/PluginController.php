<?php

namespace App\Http\Controllers;

use App\Models\Plugin;
use App\Models\PluginVersion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PluginController extends Controller
{
    public function show (Plugin $plugin) {
        if($plugin->reviewed && $plugin->public) {
            return view('plugins.show', ['plugin' => $plugin]);
        } elseif(!$plugin->reviewed || !$plugin->public) {
            if (Auth::check()) {
                if($plugin->user_id === Auth::id() || (Auth::user()->staff)) {
                    return view('plugins.show', ['plugin' => $plugin]);
                } elseif($plugin->user_id !== Auth::id()) {
                    return redirect()->route('home');
                }
            } elseif (!Auth::check()) {
                return redirect()->route('home');
            }
        }
    }

    public function update_overview (Plugin $plugin, Request $request) {
        if((Auth::id() === $plugin->user->id) || (Auth::user()->staff)) {
            $plugin->description = $request->overview;
            $plugin->save();
            return redirect()->route('plugin', ['plugin' => $plugin]);
        }
    }

    public function new_release (Plugin $plugin, Request $request) {
        if((Auth::id() === $plugin->user->id) || (Auth::user()->staff)) {
            $release = new PluginVersion;
            $release->name = $request->name;
            $release->description = $request->description;
            $release->plugin_id = $plugin->id;
            $release->save();
            $plugin->updated_at = Carbon::now();
            $plugin->save();
            return redirect()->route('plugin', ['plugin' => $plugin]);
        }
    }
}
