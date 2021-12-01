<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    @if(!$plugin->reviewed)
        <a href="#" wire:click="toggleReview()" class="btn btn-success">
            {{ __('✓ Grant plugin approval') }}
        </a>
    @elseif($plugin->reviewed)
        <a href="#" wire:click="toggleReview()" class="btn btn-danger">
            {{ __('✕ Revoke plugin approval') }}
        </a>
    @endif
</div>
