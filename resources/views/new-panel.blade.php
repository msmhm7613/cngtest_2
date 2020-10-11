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
        <div class="col-md-3 pr-0">
            <div class="">
                 @include ('layouts.panel.side-menu')
            </div>
        </div>
        <div class="col-md-9">
            <div class="content">

            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="/js/side-menu.js"></script>
@endsection
