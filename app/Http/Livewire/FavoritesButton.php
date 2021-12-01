<?php

namespace App\Http\Livewire;

use App\Models\Favorite;
use App\Models\Plugin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FavoritesButton extends Component
{
    public bool $favorite = false;
    public Plugin $plugin;

    public function mount()
    {
        $favorite = Favorite::where('user_id', Auth::id())->where('plugin_id', $this->plugin->id)->first();
        if($favorite) {
            $this->favorite = true;
        }
    }

    public function toggleFavorite()
    {
        $favorite = Favorite::where('user_id', Auth::id())->where('plugin_id', $this->plugin->id)->first();
        if($favorite) {
            $favorite->delete();
            $this->favorite = false;
        } else {
            $favorite = new Favorite;
            $favorite->user_id = Auth::id();
            $favorite->plugin_id = $this->plugin->id;
            $favorite->save();
            $this->favorite = true;
        }
    }

    public function render()
    {
        return view('livewire.favorites-button');
    }
}
