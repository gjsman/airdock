<div class="container">
    <div class="p-5 mb-4 bg-light rounded-3">
        <div class="container-fluid py-5">
            <h1 class="display-5 fw-bold">{{ __('Develop for Paper and Velocity') }}</h1>
            <p class="col-md-8 fs-4">{{ __('Paper is for the next generation of Minecraft servers; compatible with Spigot plugins while offering uncompromising performance.') }}</p>
            <p class="col-md-8 fs-4">{{ __('Velocity is a next-generation Minecraft proxy focused on scalability and flexibility. Blazing fast, extensible, and secure — choose three.') }}</p>
            <a href="{{ route('submit_new_plugin') }}" class="btn btn-lg btn-light" type="button">{{ __('Submit a plugin') }} &rarr;</a>
        </div>
    </div>

    <div class="row align-items-md-stretch">
        <div class="col-md-6 mb-2">
            <div class="h-100 p-5 text-white bg-dark rounded-3">
                <h2>{{ __('Learn about our API') }}</h2>
                <p>{{ __('Learn more about what APIs are available to you from Paper; as well as upstream APIs from Spigot. Minimize or even eliminate the need for NBTs.') }}</p>
                <a target="_blank" href="https://papermc.io/javadocs" class="btn btn-light" type="button">{{ __('View JavaDocs') }} &rarr;</a>
            </div>
        </div>
        <div class="col-md-6 mb-2">
            <div class="h-100 p-5 text-white bg-dark rounded-3">
                <h2>{{ __('An active and growing community') }}</h2>
                <p>{{ __('Paper has an active and growing community of server administrators and developers. Got problems? Come talk with us on Discord and get real time support. Want to contribute? Submit a pull request and get it reviewed this century.') }}</p>
                <a target="_blank" href="https://papermc.io/community" class="btn btn-light" type="button">{{ __('Join our community') }} &rarr;</a>
            </div>
        </div>
    </div>
</div>
