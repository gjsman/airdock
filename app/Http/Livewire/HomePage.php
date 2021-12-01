<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Platform;
use App\Models\Plugin;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class HomePage extends Component
{
    public Collection $platforms;
    public Collection $categories;
    public ?int $selected_platform = null;
    public ?int $selected_category = null;
    public ?int $selected_platform_version = null;
    public ?string $search = null;
    public ?int $results_per_page = 10;
    public ?string $sort_by = 'recently_updated';
    protected $queryString = ['selected_platform', 'selected_category', 'selected_platform_version', 'search', 'sort_by', 'results_per_page'];

    use WithPagination;
    protected string $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->platforms = Platform::all();
        $this->categories = Category::all();
    }

    public function render()
    {
        if ($this->sort_by !== 'recently_updated' && $this->sort_by !== 'alphabeticallyAZ' && $this->sort_by !== 'alphabeticallyZA') $this->sort_by = 'recently_updated';
        $plugins = Plugin::query();
        if(Auth::check()) {
            if(!(Auth::user()->staff)) {
                $plugins->where('reviewed', true);
                $plugins->where('public', true);
            }
        } elseif (!Auth::check()) {
            $plugins->where('reviewed', true);
            $plugins->where('public', true);
        }

        if ($this->search) {
            $plugins->where('name', 'LIKE', '%'.$this->search.'%');
        } else {
            if (!$this->selected_platform) $this->selected_platform_version = null;
            if ($this->selected_category) $plugins->where('category_id', $this->selected_category);
            if ($this->selected_platform) $plugins->where('platform_id', $this->selected_platform);
            if ($this->selected_platform_version) {
                $plugins->whereHas('platform_versions', function (Builder $query) {
                    $query->where('platform_version_id', $this->selected_platform_version);
                })->get();
            }
        }
        if ($this->results_per_page < 10 || $this->results_per_page > 50) $this->results_per_page = 10;

        if ($this->sort_by === 'recently_updated') {
            $plugins->orderByDesc('updated_at');
        } elseif($this->sort_by === 'alphabeticallyAZ') {
            $plugins->orderBy('name');
        } elseif($this->sort_by === 'alphabeticallyZA') {
            $plugins->orderByDesc('name');
        }

        return view('livewire.home-page', [
            'plugins' => $plugins->paginate($this->results_per_page),
        ]);
    }
}
