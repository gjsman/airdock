@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{-- Because she competes with no one, no one can compete with her. --}}
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-header">
                        {{ __('My favorites') }}
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @forelse($favorites->sortByDesc('updated_at') as $favorite)
                                @include('partials/plugin-list-item', ['plugin' => $favorite->plugin])
                            @empty
                                <p class="mb-0">{{ __('You do not have any favorites.') }}</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
