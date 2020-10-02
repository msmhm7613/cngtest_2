@php
    use App\Models\User as user;
@endphp

@guest
    redirect('/')
@endguest


@extends('layouts.head')

@section('name',Auth::user()->username)
@section ( 'page-title' , 'پنل مدیریت')

@section('content')


<div class="container-fluid">
    <div class="container">
        <div class="navbar">
            <div class="navbar-brand">
                <div>
                    {{ env('APP_NAME') }}
                </div>
                <div class="welcome">
                    <small>
                        شما به عنوان
                    </small>
                    <small>
                        @yield('name')
                    </small>
                    <small>
                        وارد شده‌اید.
                    </small>

                </div>
            </div>

            <div class="title">
                <h1 class="text-center">
                    <i class="fas fa-user-shield"></i>
                    {{ Auth::user()->title }}
                </h1>
            </div>

            <div class="account">
                <a href="logout" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i>
                    خروج
                </a>
            </div>

        </div>
    </div>
</div>
<div class="tabs pt-3">
    <!-- Nav tabs -->
<ul class="nav nav-tabs">
    @if(in_array(Auth::user()->role,array(1,2)))
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#users">
                <i class="fas fa-users ml-2"></i>
                کاربران
            </a>
        </li>
    @endif
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu1">Menu 1</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">Menu 2</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div class="tab-pane active" id="users">
        <h1>
            تنظیمات کاربران
        </h1>

        <table class="table table-striped tbl-users">
            <tr>
                <th>ردیف</th>
                <th>شناسه</th>
                <th>نام کاربری</th>
                <th>پسورد</th>
                <th>عنوان</th>
                <th>عملیات</th>
            </tr>
            @php
                $ind = 1;
            @endphp
            @foreach ( user::all() as $user )
                <tr>
                    <td>
                        {{ $ind }}
                    </td>
                    <td>
                        {{ $user->id }}
                    </td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>
                                {{ $user->username }}
                            </p>
                            <a href="#" title="ذخیره" class="btn-save" contenteditable="false">
                                <i class="fas fa-save" ></i>
                            </a>
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>
                                {{ $user->password }}
                            </p>
                            <a href="#" title="ذخیره" class="btn-save" >
                                <i class="fas fa-save"></i>
                            </a>
                        </div>
                    </td>
                    <td >
                        <div class="d-flex justify-content-between">
                            <p>
                                {{ $user->title }}
                            </p>
                            <a href="#" title="ذخیره" class="btn-save" >
                                <i class="fas fa-save"></i>
                            </a>
                        </div>
                    </td>
                    <td class="text-left">
                        <div class="hide">
                            <a href="#" class="btn btn-primary">
                                <i class="fas fa-pencil-alt"></i>
                                <small>ویرایش</small>
                            </a>
                            <a href="#" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i>
                                <small>حذف</small>
                            </a>
                        </div>
                    </td>
                </tr>
                @php
                    $ind++;
                @endphp
            @endforeach
        </table>
    </div>
    <div class="tab-pane  fade" id="menu1">...</div>
    <div class="tab-pane  fade" id="menu2">...</div>
  </div>
</div>

@endsection

@section('js')
    <script src="{{ asset('/js/my.js') }}">
    </script>
@endsection
