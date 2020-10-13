@php
use App\Models\User as user;
use App\Models\Kit as kit;

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
    <div class="col-md-3 p-0">
        @include ('layouts.panel.side-menu')
    </div>
    <div class="col-md-9">
        <div class="center" id="preloader">
            <div class="spinner-grow text-success"></div>
            <p class="loading-text">
                بارگذاری...
            </p>
        </div>
        <div id="content-box">

        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('/js/side-menu.js')}}"></script>
<script src="{{asset('/js/my.js')}}"></script>
<script src="{{asset('/js/modal.js')}}"></script>
@endsection
