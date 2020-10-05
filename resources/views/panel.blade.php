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


<div class="">
    <div class="">
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
    @if(in_array(Auth::user()->role,array(1,5)))
        <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#users">
                <i class="fas fa-store ml-2"></i>
                انبار موقت
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
        @if(in_array(Auth::user()->role, [1,2] ))
        <button class="btn btn-success" id="newUserBtn">
            <i class="fas fa-plus"></i>
            کاربر جدید
        </button>
        @endif

        <table class="table table-striped tbl-users">
            <tr>
                <th>ردیف</th>
                <th>شناسه</th>
                <th>نام کاربری</th>
                <th style="display: none;">پسورد</th>
                <th>عنوان</th>
                <th style="text-align: left;" class="w-25">

                </th>
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

                        </div>
                    </td>
                    <td >
                        <div class="d-flex justify-content-between">
                            <p>
                                {{ $user->title }}
                            </p>
                         </div>
                    </td>
                    <td class="text-left operation" >
                        <div class="hidden">
                            <button class="btn btn-info btn-sm" id="btnEdit" data-id={{ $user->id }}>
                                <i class="fas fa-pencil-alt" data-id={{ $user->id }}></i>
                                <small data-id={{ $user->id }}>ویرایش</small>
                            </button>
                            <button class="btn btn-danger btn-sm" id="btnDelete" data-id={{ $user->id }}>
                                <i class="fas fa-trash-alt"></i>
                                <small>حذف</small>
                            </button>
                        </div>
                    </td>
                </tr>
                @php
                    $ind++;
                @endphp
            @endforeach
        </table>
    </div>
    <div class="tab-pane" id="kits">
        <h1>
            انبار موقت
        </h1>
        @if(in_array(Auth::user()->role, [1,5] ))
        <button class="btn btn-success" id="newUserBtn">
            <i class="fas fa-plus"></i>
            رسید کالا
        </button>
        @endif

        <table class="table table-striped tbl-users">
            <tr>
                <th>ردیف</th>
                <th>سریال</th>
                <th>وضعیت</th>
                <th>وضعیت قطعات همراه</th>
            </tr>
            @php
                $ind = 1;
            @endphp
            @foreach ( kit::all() as $kit )
                <tr>
                    <td>
                        {{ $ind }}
                    </td>
                    <td>
                        {{ $kit->serial }}
                    </td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>
                                @if ( $kit->status )
                                {{ سالم }}
                                @else
                                {{ معیوب }}
                                @endif
                            </p>

                        </div>
                    </td>
                    <td >
                        <div class="d-flex justify-content-between">
                            <p>
                                @if ( $kit->pack_status )
                                {{ سالم }}
                                @else
                                {{ معیوب }}
                                @endif
                            </p>
                         </div>
                    </td>
                    <td class="text-left operation" >
                        <div class="hidden">
                            <button class="btn btn-info btn-sm" id="btnEdit" data-id={{ $user->id }}>
                                <i class="fas fa-pencil-alt" data-id={{ $user->id }}></i>
                                <small data-id={{ $user->id }}>ویرایش</small>
                            </button>
                            <button class="btn btn-danger btn-sm" id="btnDelete" data-id={{ $user->id }}>
                                <i class="fas fa-trash-alt"></i>
                                <small>حذف</small>
                            </button>
                        </div>
                    </td>
                </tr>
                @php
                    $ind++;
                @endphp
            @endforeach
        </table>
    </div>

    <div class="tab-pane  fade" id="menu2">...</div>
  </div>
</div>

{{-- Start of Add Modal --}}

<div class="modal fade" id="create">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form action="" method="POST" class="form-horizontal" id="insert-user-form">
                    @csrf
                    <div class="form-group row add">
                        {{-- <label for="title" class="control-label col-sm-2">{{ نام کاربری: }}</label> --}}
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class=" inset" placeholder="نام کاربری" id="username" name="username">
                                @error('username')
                                    <small id="small-1">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class=" inset" placeholder="رمز عبور" id="password" name="password">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select name="role" id="role" class="form-control">
                                    <option value=1>
                                        {{ 'مدیر سیستم' }}
                                    </option>
                                    <option value=2>
                                        {{ 'مسئول سایت' }}
                                    </option>
                                    <option value=3>
                                        {{ 'پیمانکار' }}
                                    </option>
                                    <option value=4>
                                        {{ 'انبار' }}
                                    </option>
                                    <option value=5>
                                        {{ 'انبار موقت' }}
                                    </option>
                                    <option value=6>
                                        {{ 'کارگاه' }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="alert alert-danger errors hidden" id="response"></div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="add">
                    <span class="fas fa-plus"></span>
                    اضافه
                </button>
                <button class="btn btn-info" type="button" data-dismiss="modal"  >
                    <span class="fas fa-remove"></span>
                    انصراف
                </button>
            </div>
        </div>

    </div>
</div>


{{-- End of Add Model --}}


{{-- ************************* --}}
{{-- ************************* --}}
{{-- ************************* --}}
{{-- ************************* --}}


{{-- Start of Edit Modal --}}

<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="preloader d-flex justify-content-center align-center text-center flex-column">
                    {{-- <div class="spinner-border">

                    </div>
                    <div>Loading...</div> --}}
                </div>
                <form action="" method="POST" class="form-horizontal" id="edit-user-form">
                    @csrf
                    <div class="form-group row add">
                        {{-- <label for="title" class="control-label col-sm-2">{{ نام کاربری: }}</label> --}}
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class=" inset" placeholder="نام کاربری" id="editUsername" name="username">
                                @error('username')
                                    <small id="small-1">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class=" inset" placeholder="رمز عبور" id="editPassword" name="password">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select name="role" id="editRole" class="form-control">
                                    <option value=1>
                                        {{ 'مدیر سیستم' }}
                                    </option>
                                    <option value=2>
                                        {{ 'مسئول سایت' }}
                                    </option>
                                    <option value=3>
                                        {{ 'پیمانکار' }}
                                    </option>
                                    <option value=4>
                                        {{ 'انبار' }}
                                    </option>
                                    <option value=5>
                                        {{ 'انبار موقت' }}
                                    </option>
                                    <option value=6>
                                        {{ 'کارگاه' }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="alert alert-danger" id="selectResponse"></div>
            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="edit" >
                    <span class="fas fa-plus"></span>
                    ثبت
                </button>
                <button class="btn btn-info" type="button" data-dismiss="modal"  >
                    <span class="fas fa-remove"></span>
                    انصراف
                </button>
            </div>
        </div>

    </div>
</div>


{{-- End of Edit Modal --}}

{{-- START OF DELETE USER --}}

<div class="modal fade" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header alert-danger">
                <button class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title "></h4>
            </div>
            <div class="modal-body">
                <form action="/deleteUser" method="post">
                    @csrf
                </form>
                <span>آیا مطمئنید میخواهید کاربر</span>
                <span id="sureDeleteUsername"></span>
                <span id="sureDeleteRole"></span>
                <span>را حذف کنید؟</span>
            </div>
            <div class="modal-footer">
                <div id="deleteResponse" class="alert alert-danger"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="submit" id="modalBtnDelete" >
                    <span class="fas fa-delete"></span>
                    حذف
                </button>
                <button class="btn btn-info" id="deleteCancel" type="button"  data-dismiss="modal"  >
                    <span class="fas fa-cancel"></span>
                    انصراف
                </button>
            </div>
        </div>

    </div>
</div>

@endsection

@section('js')
    <script src="{{ asset('/js/my.js') }}">
    </script>
    <script src="{{ asset('/js/modal.js') }}"></script>
@endsection
