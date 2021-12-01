<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function show()
    {
        $favorites = Favorite::where('user_id', Auth::id())->get();
        return view('favorites.show', ['favorites' => $favorites]);
    }
}
