<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Platform;
use App\Models\Plugin;
use App\Models\PluginVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DeveloperController extends Controller
{
    public function index()
    {
        return view('developers.index');
    }

    public function submit()
    {
        return view('developers.submit');
    }

    public function submit_post(Request $request)
    {
        if(Auth::check()) {
            // TODO: Validation!

            $plugin = new Plugin();
            $plugin->name = $request->name;
            $plugin->summary = $request->summary;
            $plugin->description = $request->description;
            $plugin->user_id = Auth::id();

            if(Platform::where('id', $request->platform)->first() === null) {
                dd('Invalid Platform');
            }
            if(Category::where('id', $request->category)->first() === null) {
                dd('Invalid Category');
            }

            $plugin->platform_id = $request->platform;
            $plugin->category_id = $request->category;
            $plugin->save();

            $latest_platform_version = Platform::where('id', $request->platform)->first()->versions()->latest()->first();
            if($latest_platform_version !== null) {
                DB::table('platform_version_plugin')->insert([
                    'plugin_id' => $plugin->id,
                    'platform_version_id' => $latest_platform_version->id
                ]);
            }

            $version = new PluginVersion;
            $version->name = $request->version;
            $version->description = "Initial version on Airdock.";
            $version->plugin_id = $plugin->id;
            $version->save();

            return redirect()->route('developers');
        }
    }
}
