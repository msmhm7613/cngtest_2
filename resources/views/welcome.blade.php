@extends ('layouts.app')

@section ( 'content' )

    <div class="container">
        <a href="#" class="btn btn-primary">{{ config('app.name','boluki') }}</a>
        <h4>
            {{ $db }}
        </h4>
    </div>

@endsection