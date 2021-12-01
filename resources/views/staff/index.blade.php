@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            {{-- Because she competes with no one, no one can compete with her. --}}
            <div class="col-md-12">
                <div class="card mb-2">
                    <div class="card-header">
                        {{ __('Staff') }}
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            {{ __('If you need assistance privately, you can contact our staff using the information below.') }}
                        </div>
                        <div class="alert alert-danger">
                            {{ __('Please contact staff privately as a last resort for issues that cannot be resolved publicly on GitHub or Discord. Anything that can be resolved in public will be ignored.') }}
                        </div>
                        <div class="list-group">
                            @forelse(\App\Models\User::where('staff', '=', true)->get() as $staff)
                                <div class="list-group-item flex-column align-items-start">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h5 class="mb-1">{{ $staff->name }}</h5>
                                    </div>
                                    <p class="mb-0">{{ $staff->email }}</p>
                                    <small class="text-muted">

                                    </small>
                                </div>
                            @empty
                                <p class="mb-0">{{ __('There are no staff available.') }}</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
