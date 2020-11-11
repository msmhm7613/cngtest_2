@php
use App\Models\User as user;
@endphp

<div id="insert-new-user-form-container">
    <a href="#" class="btn btn-success" id="newUserBtn">
        کاربر جدید
    </a>

    
    <div class="response">
        <ul>

        </ul>
    </div>
</div>

<!--
<div class="eng">
    <?php
    //echo Str::random(8);
    ?>
</div>
-->

@if (App\Models\User::all()->count())
<table class="table table-striped tbl-users" id="tbl-users" style="z-index: 999;">
    <tr>
        <th>ردیف</th>
        <th>شناسه</th>
        <th>نام کاربری</th>
        <th style="display: none;">پسورد</th>
        <th>عنوان</th>
        <th style="text-align: left;" class="w-25">
            عملیات
        </th>
    </tr>
    @php
    $ind = 1;
    @endphp
    @foreach (user::all() as $user)
    <tr id="{{ 'tr-' . strval($ind) }}" aria-disabled="true">
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
        <td>
            <div class="d-flex justify-content-between">
                <p>
                    {{ $user->title }}
                </p>
            </div>
        </td>
        <td class="text-left operation">
            <div class="{!!  'hidden' !!}">
                @if ($ind == 1)

                <div class="lock">
                    <i class="fas fa-lock" style="display: block;"></i>
                </div>

                @endif
                <button class="btn btn-info btn-sm my-1 w-25 d-inline-block " title="ویرایش" id="btnEdit" data-id={{ $user->id }}>
                    <i class="fas fa-pencil-alt m-0 "></i>

                </button>
                <button class="btn btn-danger btn-sm my-1 w-25 d-inline-block" title="حذف" id="btnDelete" data-id={{ $user->id }}>
                    <i class="fas fa-trash-alt m-0 "></i>

                </button>
            </div>
        </td>
    </tr>
    @php
    $ind++;
    @endphp
    @endforeach
</table>
@else
<div class="alert alert-info mt-5">
    <p>
        هیچ کاربری ثبت نشده است.
    </p>
</div>
@endif


@include('layouts.modals.user.insert-new-user')
@include('layouts.modals.user.edit-user')
@include('layouts.modals.user.delete-user')
