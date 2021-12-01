<div>
    {{-- The Master doesn't talk, he acts. --}}
    @if(!$plugin->public)
        <a href="#" wire:click="togglePublicity()" class="btn btn-success">
            {{ __('✓ Make this plugin publicly available') }}
        </a>
    @elseif($plugin->public)
        <a href="#" wire:click="togglePublicity()" class="btn btn-danger">
            {{ __('✕ Make this plugin publicly unavailable') }}
        </a>
    @endif
</div>
