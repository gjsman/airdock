<?php

namespace App\Http\Livewire;

use App\Models\Plugin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PluginReviewedControlButton extends Component
{
    public Plugin $plugin;

    public function render()
    {
        return view('livewire.plugin-reviewed-control-button');
    }

    public function toggleReview()
    {
        if (Auth::user()->staff) {
            $this->plugin->reviewed = !$this->plugin->reviewed;
            $this->plugin->save();
            $this->emit('review_changed');
        }
    }
}
