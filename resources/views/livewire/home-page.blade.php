<div class="container">
    <div class="row justify-content-center">
        {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
        <div class="col-md-4">
            <div class="card mb-2">
                <div class="card-header">
                    {{ __('Filters') }}

                    <div wire:loading style="color: white; background-color: green; padding-left: 8px; margin-left: 8px; padding-right: 8px; border-radius: 4px;">
                        <strong>
                            {{ __('Loading...') }}
                        </strong>
                    </div>
                </div>

                <div class="card-body">
                    <input type="text" class="form-control" placeholder="{{ __('Search') }}" wire:model.150ms="search" />
                    @if(!$search)
                        <br/>
                        <h5>
                            {{ __('Platforms') }}
                        </h5>
                        <ul>
                            @if($selected_platform === null)
                                <li><strong>{{ __('All platforms') }}</strong></li>
                            @elseif($selected_platform !== null)
                                <li><a href="#" wire:click="$set('selected_platform', null)">{{ __('All platforms') }}</a></li>
                            @endif
                            @foreach($platforms as $platform)
                                <li>
                                    @if($selected_platform === $platform->id)
                                        <strong>{{ $platform->name }}</strong>
                                        <ul>
                                            @if($selected_platform_version === null)
                                                <li><strong>{{ __('All versions') }}</strong></li>
                                            @elseif($selected_platform_version !== null)
                                                <li><a href="#" wire:click="$set('selected_platform_version', null)">{{ __('All platforms') }}</a></li>
                                            @endif
                                            @foreach($platform->versions as $version)
                                                @if($selected_platform_version === $version->id)
                                                    <li><strong>{{ $version->name }}</strong></li>
                                                    @elseif($selected_platform_version !== $version->id)
                                                    <li><a href="#" wire:click="$set('selected_platform_version', {{ $version->id }})">{{ $version->name }}</a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @elseif($selected_platform !== $platform->id)
                                        <a href="#" wire:click="$set('selected_platform', {{ $platform->id }})">{{ $platform->name }}</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        <h5>
                            {{ __('Categories') }}
                        </h5>
                        <ul>
                            @if($selected_category === null)
                                <li><strong>{{ __('All categories') }}</strong></li>
                            @elseif($selected_category !== null)
                                <li><a href="#" wire:click="$set('selected_category', null)">{{ __('All categories') }}</a></li>
                            @endif
                            @foreach($categories as $category)
                                <li>
                                    @if($selected_category === $category->id)
                                        <strong>{{ $category->name }}</strong>
                                    @elseif($selected_category !== $category->id)
                                        <a href="#" wire:click="$set('selected_category', {{ $category->id }})">{{ $category->name }}</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        <h5>
                            {{ __('Sort by') }}
                        </h5>
                        <div class="form-group mb-3">
                            <select class="form-control" id="sort_by" wire:model="sort_by">
                                <option value="recently_updated">{{ __('Recently updated') }}</option>
                                <option value="alphabeticallyAZ">{{ __('Alphabetically A-Z') }}</option>
                                <option value="alphabeticallyZA">{{ __('Alphabetically Z-A') }}</option>
                            </select>
                        </div>
                        <h5>
                            {{ __('Results per page') }}
                        </h5>
                        <div class="form-group mb-3">
                            <select class="form-control" id="results_per_page" wire:model="results_per_page">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                            </select>
                        </div>
                    @elseif($search)
                        <br/>
                        <div class="alert alert-info" role="alert">
                            <p class="mb-0">Showing search results from all categories and platforms. <a href="#" wire:click="$set('search', null)">Cancel search</a></p>
                        </div>
                    @endif
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
            <div class="card">
                <div class="card-header">
                    @if(!$search)
                        {{ __('Browse for plugins') }}
                    @elseif($search)
                        {{ __('Search results') }}
                    @endif
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p class="mb-0">
                        @if(!$search)

                        @elseif($search)

                        @endif
                    </p>

                    <div class="list-group">
                        @foreach($plugins as $plugin)
                            @include('partials/plugin-list-item')
                        @endforeach
                    </div>

                    {{ $plugins->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
