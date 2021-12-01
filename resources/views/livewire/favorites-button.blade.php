<div>
    {{-- Do your work, then step back. --}}
    @if(!$favorite)
        <a href="#" wire:click="toggleFavorite()" class="btn btn-success">
            {{ __('★ Add to favorites') }}
        </a>
    @elseif($favorite)
        <a href="#" wire:click="toggleFavorite()" class="btn btn-danger">
            {{ __('★ Remove from favorites') }}
        </a>
    @endif
</div>
