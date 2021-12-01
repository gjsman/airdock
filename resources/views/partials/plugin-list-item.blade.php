<a href="{{ route('plugin', $plugin) }}" class="list-group-item list-group-item-action flex-column align-items-start">
    <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">{{ $plugin->name }}</h5>
        <small class="text-muted">{{ __('Updated ').$plugin->latest_version()->updated_at->diffForHumans() }}</small>
    </div>
    <p class="mb-1">{{ $plugin->summary }}</p>
    <small class="text-muted">
        {{ $plugin->category->name.__('; Compatible with ').$plugin->platform->name.' '.$plugin->platform_versions->pluck('name')->implode(', ') }}

        @if(!$plugin->reviewed)
            <br/>
            <span class="" style="color: maroon;"><strong>This plugin is awaiting review.</strong></span>
        @endif
        @if(!$plugin->public)
            <br/>
            <span class="" style="color: maroon;"><strong>This plugin is hidden from public view.</strong></span>
        @endif
    </small>
</a>
