<?php

namespace App\Http\Livewire;

use App\Models\Ad;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdsPage extends Component
{
    public Collection $ads;

    public function mount()
    {
        $this->ads = Ad::all();
    }

    public function render()
    {
        return view('livewire.ads-page');
    }

    public function deleteAd(Ad $ad)
    {
        if(Auth::user()->staff) {
            $ad->delete();
            $this->ads = Ad::all();
        }
    }
}
