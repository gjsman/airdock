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

            $request->validate([
                'name' => 'required|max:255',
                'file' => 'required|mimes:jar|max:32768'
            ]);

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

            $file_name = $request->file->getClientOriginalName().'_'.$plugin->id.'_'.time().'.jar';
            if (env('FILESYSTEM_DRIVER') === 's3') {
                $file_path = $request->file('file')->storePubliclyAs('uploads', $file_name);
            } else {
                $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
            }

            $version->file_path = $file_path;
            $version->save();

            return redirect()->route('developers');
        }
    }
}
