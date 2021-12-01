<?php

namespace App\Http\Livewire;

use App\Models\Plugin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PluginPublicControlButton extends Component
{
    public Plugin $plugin;

    public function render()
    {
        return view('livewire.plugin-public-control-button');
    }

    public function togglePublicity()
    {
        if ((Auth::id() === $this->plugin->user_id) || (Auth::user()->staff)){
            $this->plugin->public = !$this->plugin->public;
            $this->plugin->save();
        }
    }
}
