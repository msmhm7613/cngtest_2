@php
    use App\Models\User as user;
    use App\Models\Kit as kit;
@endphp

@guest
    redirect('/')
@endguest


@extends('layouts.head')

@if(!Auth::user())
<script>window.location = "/login";</script>
@endif

@section('name',Auth::user()->username??"")
@section ( 'page-title' , 'پنل مدیریت')

@section('content')

{{-- Header --}}
@include('layouts.panel.header')

<!-- Tab panes -->
@include('layouts.panel.tab-pane')

{{-- Table --}}
@include('layouts.store.table')


{{-- Temp Store Add Product Modal --}}
@include('layouts.store.modals.insert-new-product')

{{-- Start of Add Modal --}}
@include('layouts.user.modals.insert-new-user')


{{-- Start of Edit Modal --}}
@include('layouts.user.modals.edit-user')



{{-- End of Edit Modal --}}

{{-- START OF DELETE USER --}}

@include('layouts.user.modals.delete-user')

@endsection

@section('js')
    <script src="{{ asset('/js/my.js') }}"></script>
    <script src="{{ asset('/js/modal.js') }}"></script>
@endsection
