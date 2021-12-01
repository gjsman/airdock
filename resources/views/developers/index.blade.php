@extends('layouts.app')

@section('content')
    @if(\Illuminate\Support\Facades\Auth::check())
        @if(\Illuminate\Support\Facades\Auth::user()->plugins->isNotEmpty())
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4 mb-2">
                        <div class="card mb-2">
                            <div class="card-header">
                                {{ __('Developer Center') }}
                            </div>
                            <div class="card-body">
                                <p>{{ __('Welcome to the Developer Center!') }}</p>
                                <a href="{{ route('submit_new_plugin') }}" class="btn btn-primary">{{ __('Submit a new plugin') }} &rarr;</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 mb-2">
                        <div class="card mb-2">
                            <div class="card-header">
                                {{ __('My Plugins') }}
                            </div>
                            <div class="card-body">
                                <div class="list-group">
                                    @foreach(\Illuminate\Support\Facades\Auth::user()->plugins->sortByDesc('updated_at') as $plugin)
                                        @include('partials/plugin-list-item')
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            @include('partials/developer-splash')
        @endif
    @elseif(!\Illuminate\Support\Facades\Auth::check())
        @include('partials/developer-splash')
    @endif
@endsection
