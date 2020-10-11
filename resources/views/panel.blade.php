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

    {{-- tab pane
    @include('layouts.panel.tab-pane')--}}

    <div id="tab-content">

    </div>

@endsection

@section('js')
    <script src="{{ asset('/js/my.js') }}"></script>
    <script src="{{ asset('/js/tab/tab-init.js') }}"></script>
@endsection
