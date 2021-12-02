<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdController extends Controller
{
    public function index() {
        if (Auth::user()->staff) {
            return view('ads.index');
        }
    }

    public function submit(Request $request) {
        if (Auth::user()->staff) {
            $request->validate([
                'url' => 'required|max:255',
                'file' => 'required|mimes:png,jpg,jpeg,tiff|max:2048'
            ]);
            $ad = new Ad;
            $ad->url = $request->url;
            $file_name = 'Ad_'.time().'_'.$request->file->getClientOriginalName();
            if (env('FILESYSTEM_DRIVER') === 's3') {
                $file_path = $request->file('file')->storePubliclyAs('ads', $file_name);
            } else {
                $file_path = $request->file('file')->storeAs('ads', $file_name, 'public');
            }
            $ad->file_path = $file_path;
            $ad->save();
            return redirect()->route('ads');
        }
    }
}
