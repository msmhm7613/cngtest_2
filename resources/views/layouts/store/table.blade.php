@php
    use App\Models\User as user;
    use App\Models\Kit as kit;
@endphp
<div class="tab-content mt-4">
    <div class="tab-pane active" id="users">
        <h3>
            تنظیمات کاربران
        </h3>
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
                <tr id="{{ 'tr-'.strval($ind) }}" aria-disabled="true">
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
                    <td class="text-left operation">
                        <div class="{!! 'hidden' !!}">
                            @if($ind==1)

                                <div class="lock">
                                    <i class="fas fa-lock" style="display: block;"></i>
                                </div>

                            @endif
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
        <h3>
            <i class="fas fa-store"></i>
            انبار موقت
        </h3>
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
    <div class="tab-pane" id="workshops">
        <h3>
            <i class="fas fa-wrench"></i>
            کارگاه
        </h3>
        @if(in_array(Auth::user()->role, [1,6] ))
        <button class="btn btn-success" id="insert-new-workshop-modal-btn">
            <i class="fas fa-plus"></i>
            کارگاه جدید
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


  </div>
