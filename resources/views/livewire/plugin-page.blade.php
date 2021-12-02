<div class="container">
    <div class="row justify-content-center">
        {{-- Because she competes with no one, no one can compete with her. --}}
        <div class="col-md-4">
            <div class="card mb-2">
                <div class="card-header">
                    {{ __('Plugin information') }}
                </div>
                <div class="card-body">
                    <h5>{{ $plugin->name }}</h5>
                    <p>{{ $plugin->summary }}</p>
                    <ul class="mb-0">
                        @if(!$plugin->reviewed)
                            <li><span class="" style="color: maroon;"><strong>This plugin is awaiting review.</strong></span></li>
                        @endif
                        @if(\Illuminate\Support\Facades\Auth::check())
                            @if((\Illuminate\Support\Facades\Auth::id() === $plugin->user->id))
                                <li>{{ __('Author: ') }}<strong>{{ __('Yourself') }}</strong></li>
                            @elseif(\Illuminate\Support\Facades\Auth::id() !== $plugin->user->id)
                                <li>{{ __('Author: ').$plugin->user->name }}</li>
                            @endif
                        @else
                            <li>{{ __('Author: ').$plugin->user->name }}</li>
                        @endif
                        <li>{{ __('Category: ').$plugin->category->name }}</li>
                        @if($plugin->latest_version())
                            <li>{{ __('Current version: ').$plugin->latest_version()->name }}</li>
                        @endif
                        <li>{{ __('Compatible with ').$plugin->platform->name.' '.$plugin->platform_versions->pluck('name')->implode(', ') }}</li>
                        <li>{{ __('Updated ').$plugin->latest_version()->updated_at->diffForHumans() }}</li>
                    </ul>
                    @if($plugin->latest_version())
                        @if((string) $plugin->latest_version()->file_path)
                            <a href="{{ url((string) $plugin->latest_version()->file_path) }}" class="btn btn-primary mt-3">&darr; &nbsp; {{ __('Download') }}</a>
                        @endif
                    @elseif(!$plugin->latest_version())
                        <p>{{ __('This plugin does not have any available released versions. Hopefully one is coming soon.') }}</p>
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::check())
                        <div class="mt-4">
                            @livewire('favorites-button', ['plugin' => $plugin])
                        </div>
                        @if((Auth::user()->staff))
                            <div class="mt-4">
                                @livewire('plugin-reviewed-control-button', ['plugin' => $plugin])
                            </div>
                        @endif
                        @if((\Illuminate\Support\Facades\Auth::id() === $plugin->user_id) || (Auth::user()->staff))
                            <div class="mt-4">
                                @livewire('plugin-public-control-button', ['plugin' => $plugin])
                            </div>
                        @endif
                    @elseif(!\Illuminate\Support\Facades\Auth::check())
                        <div class="alert alert-info mt-4 mb-0 pt-2 pb-2">
                            {{ __('Sign in to add this to your favorites.') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header">
                    {{ __('Other plugins by ').$plugin->user->name }}
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        @foreach($plugin->user->plugins->where('public', true)->where('reviewed', true) as $other_plugin)
                            @if($other_plugin->id !== $plugin->id)
                                <li><a href="{{ route('plugin', $other_plugin) }}">{{ $other_plugin->name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="card mb-2">
                <div class="card-header">
                    {{ __('Sponsor') }}
                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-2">
                <div class="card-header">
                    <nav class="nav nav-pills nav-fill">
                        <a class="nav-link @if($tab === 1) active @endif" href="#" wire:click="$set('tab', 1)">Overview</a>
                        <a class="nav-link @if($tab === 2) active @endif" href="#" wire:click="$set('tab', 2)">Versions</a>
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Discussion</a>
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Reviews</a>
                    </nav>
                </div>
                <div class="card-body">
                    @if($tab === 1)
                        @if(\Illuminate\Support\Facades\Auth::check())
                            @if((\Illuminate\Support\Facades\Auth::id() === $plugin->user->id) || (Auth::user()->staff))
                                @if($editing_overview)
                                    <form action="/form/update-overview/{{ $plugin->id }}" method="POST">
                                        @csrf
                                        <x-easy-mde name="overview">{{ $plugin->description }}</x-easy-mde>
                                        <button type="submit" class="btn btn-primary">{{ __('Save changes') }}</button>
                                    </form>
                                @elseif(!$editing_overview)
                                    <a href="#" class="btn btn-dark mb-3" wire:click="$set('editing_overview', true)">{{ __('Edit the overview') }}</a>
                                    {!! $converter->convertToHtml($plugin->description) !!}
                                @endif
                            @elseif(\Illuminate\Support\Facades\Auth::id() !== $plugin->user->id)
                                {!! $converter->convertToHtml($plugin->description) !!}
                            @endif
                        @elseif(!\Illuminate\Support\Facades\Auth::check())
                            {!! $converter->convertToHtml($plugin->description) !!}
                        @endif
                        {{-- Don't use the description directly, it's unsanitized. --}}
                    @elseif($tab === 2)
                        @if(\Illuminate\Support\Facades\Auth::check())
                            @if((\Illuminate\Support\Facades\Auth::id() === $plugin->user->id) || (Auth::user()->staff))
                                @if(!$editing_new_release)
                                    <a href="#" class="btn btn-dark mb-3" wire:click="$set('editing_new_release', true)">{{ __('Publish a new release') }}</a>
                                    @if($errors->any())
                                        {!! implode('', $errors->all('<div class="alert alert-danger">Error: :message</div>')) !!}
                                    @endif
                                @elseif($editing_new_release)
                                    <form action="/form/new-release/{{ $plugin->id }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label for="name">{{ __('Release name') }}</label>
                                            <input type="text" name="name" required class="form-control bg-white" id="name" placeholder="Name of the release">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="file">{{ __('Plugin file') }}</label>
                                            <br/>
                                            <input type="file" class="form-control" id="file" name="file">
                                        </div>
                                        <x-easy-mde name="description" />
                                        <button type="submit" class="btn btn-primary mb-3">{{ __('Save changes') }}</button>
                                    </form>
                                @endif
                            @endif
                        @endif
                        <div class="accordion" id="versions">
                            @forelse($plugin->versions->sortByDesc('created_at') as $key=>$version)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="accordion-entry-{{ $key }}">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $key }}" aria-expanded="true" aria-controls="collapse-{{ $key }}">
                                            {{ $version->name }} - {{ __('Released ').$version->created_at->diffForHumans() }} - #{{ $key + 1 }}
                                        </button>
                                    </h2>
                                    <div id="collapse-{{ $key }}" class="accordion-collapse collapse @if($loop->first) show @endif" aria-labelledby="accordion-entry-{{ $key }}" data-bs-parent="#versions">
                                        <div class="accordion-body bg-white">
                                            {!! $converter->convertToHtml($version->description) !!}
                                            @if((string) $version->file_path)
                                                <a href="{{ url((string) $version->file_path) }}" class="btn btn-primary">&darr; &nbsp; {{ __('Download') }}</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="accordion-entry-1">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">
                                            {{ __('No released versions available') }}
                                        </button>
                                    </h2>
                                    <div id="collapse-1" class="accordion-collapse collapse show" aria-labelledby="accordion-entry-1" data-bs-parent="#versions">
                                        <div class="accordion-body bg-white">
                                            {{ __('This plugin does not have any available released versions. Hopefully one is coming soon.') }}
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
