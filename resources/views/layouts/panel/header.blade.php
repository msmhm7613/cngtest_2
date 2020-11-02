<div class="bg-dark header text-light p-2 container">
    @include('layouts.slider.slider')
    <div class="">
        <div class="d-flex">
            <h5>
                {{ env('APP_NAME') }}
            </h5>
            <small title=" {{ $Version[1] }} " class="eng text-warning">
                ({{ $Version[0] }})
            </small>
        </div>
    </div>
</div>
