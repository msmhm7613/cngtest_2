@php
use App\Models\User as user;
use App\Models\Kit as kit;
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
@endphp
@guest
    {{ redirect('/login') }}
@endguest
@extends('layouts.head')


@if (!Auth::user())
    <script>
        window.location = "/login";

    </script>
@endif

@section('name', Auth::user()->username ?? '')
@section('page-title', 'پنل مدیریت')

@section('content')
    <div class="row">
        <div class="col-md-3">
            @include ('layouts.panel.side-menu')
        </div>
        <div class="col-md-9" >
            <div class="" id="preloader">
                <div class="spinner-grow text-success"></div>
                <p class="loading-text text-light">
                    بارگذاری...
                </p>

                <lottie-player src="{{ asset('storage/images/loader/1.json') }}" background="" speed="1"
                    style="width: 100px; height: 100px;" loop autoplay></lottie-player>

            </div>
            <div id="content-box">

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('/js/side-menu.js') }}"></script>
    {{-- <script src="{{ asset('/js/my.js') }}"></script> --}}
    <script src="{{ asset('/js/modal.js') }}"></script>
@endsection
