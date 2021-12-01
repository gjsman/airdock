<?php

namespace App\Http\Livewire;

use App\Models\Plugin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use League\CommonMark\CommonMarkConverter;

class PluginPage extends Component
{
    public Plugin $plugin;
    public int $tab = 1;
    protected $queryString = ['tab'];
    public bool $editing_overview = false;
    public bool $editing_new_release = false;
    protected $listeners = ['review_changed' => 'render'];

    public function mount()
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        // Todo: Weigh merits of pre-sanitizing HTML before database entry instead of on-generation
        if (!$this->plugin->description) $this->plugin->description = '';
        $this->overview = $this->plugin->description;
    }

    public function render()
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        return view('livewire.plugin-page', ['converter' => $converter]);
    }
}
