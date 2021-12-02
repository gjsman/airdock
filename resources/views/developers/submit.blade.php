@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 mb-2">
                <div class="card mb-2">
                    <div class="card-header">
                        {{ __('Submit a new plugin') }}
                    </div>
                    <div class="card-body">
                        <p>
                            {{ __('If you are submitting a plugin, congratulations, and thank you for contributing! Every plugin helps build the Paper and Velocity ecosystem.') }}
                        </p>
                        <p>
                            {{ __('Before filling out this form, we recommend reviewing our Plugin Guidelines and making sure your plugin is something we would be comfortable with publishing to a larger audience.') }}
                        </p>
                        <p>
                            {{ __('In general, make sure your plugin brings unique new functionality not replicated by other plugins, is family friendly, does not have obvious security flaws, and does not violate the copyright of others.') }}
                        </p>
                        <p>
                            {{ __('After filling out this form, our staff and developers will review your submission. Please allow up to a week for processing as this is a volunteer effort and our developers are very busy. During that week of allowed time, do not ask for an approval ETA.') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 mb-2">
                <div class="card mb-2">
                    <div class="card-header">
                        {{ __('Form') }}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/developer/submit" enctype="multipart/form-data">
                            @csrf
                            @if($errors->any())
                                {!! implode('', $errors->all('<div class="form-group mb-3"><div class="alert alert-danger">Error: :message</div></div>')) !!}
                            @endif
                            <div class="form-group mb-3">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" required name="name" class="form-control" id="name" placeholder="{{ __('SuperMobSmasher') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="summary">{{ __('Summary (should be about one sentence in length)') }}</label>
                                <input type="text" required name="summary" class="form-control" id="summary" placeholder="{{ __('Eliminate mobs by putting them in boxes and smashing them with hammers!') }}">
                            </div>
                            <div class="form-group mb-3">
                                <label for="version">{{ __('Current version') }}</label>
                                <input type="text" required name="version" class="form-control" id="version" placeholder="v1.2.7">
                            </div>
                            <div class="form-group mb-3">
                                <label for="platform">{{ __('Platform') }}</label>
                                <select class="form-control" id="platform" name="platform">
                                    @foreach(\App\Models\Platform::all() as $platform)
                                        <option value="{{ $platform->id }}">{{ $platform->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="category">{{ __('Category') }}</label>
                                <select class="form-control" id="category" name="category">
                                    @foreach(\App\Models\Category::all() as $category)
                                        <option value="{{ $category->id }}" @if($category->name === 'Miscellaneous') selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="alert alert-danger mb-3">
                                {{ __('We only accept submissions that run on the latest-supported platform versions - though you can add support for older versions later by changing your plugin settings.') }}
                            </div>
                            <div class="form-group mb-3">
                                <label for="file">{{ __('Plugin file') }}</label>
                                <br/>
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            <div class="form-group mb-3">
                                <label for="description">{{ __('Description (please be detailed)') }}</label>
                                <x-easy-mde name="description" />
                            </div>
                            <div class="alert alert-danger mb-3">
                                {{ __('By submitting this plugin, you certify that this plugin is your original work (or that you have the legal authority to submit this plugin), and that it complies with the Plugin Guidelines.') }}
                            </div>
                            <div class="alert alert-danger mb-3">
                                {{ __('You cannot submit a second plugin if you have a different plugin awaiting review.') }}
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
