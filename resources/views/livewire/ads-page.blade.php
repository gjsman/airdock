<div class="container">
    <div class="row justify-content-center">
        {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
        <div class="col-md-4">
            <div class="card mb-2">
                <div class="card-header">
                    {{ __('New ad') }}
                </div>
                <div class="card-body">
                    <form method="POST" action="/ads" enctype="multipart/form-data">
                        @csrf
                        @if($errors->any())
                            {!! implode('', $errors->all('<div class="form-group mb-3"><div class="alert alert-danger">Error: :message</div></div>')) !!}
                        @endif
                        <div class="form-group mb-3">
                            <label for="url">{{ __('URL on click') }}</label>
                            <input type="text" required name="url" class="form-control" id="url" placeholder="{{ __('https://example.com/') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="file">{{ __('Ad image') }}</label>
                            <br/>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-2">
                <div class="card-header">
                    {{ __('Currently running ads') }}
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($ads as $ad)
                            <div class="list-group-item flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"></h5>
                                    <small class="text-muted"></small>
                                </div>
                                <p class="mb-1">
                                    <img src="{{ url(Storage::url((string) $ad->file_path)) }}" alt="Advertisement" style="max-width: 150px;" />
                                </p>
                                <small class="text-muted">
                                    {{ $ad->url }}
                                    <br/>
                                    {{ __('Updated ').$ad->updated_at->diffForHumans() }}
                                </small>
                                <p class="mb-0 mt-2"><button wire:click="deleteAd({{ $ad->id }})" class="btn btn-danger">Delete</button></p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
