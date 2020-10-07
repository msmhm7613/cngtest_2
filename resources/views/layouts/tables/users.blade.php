@php
    use App\Models\User as user;
@endphp

<div class="tab-pane active" id="users">
    @if (App\Models\User::all()->count())
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
    @else
        <div class="alert alert-info mt-5">
            <p>
                هیچ کاربری ثبت نشده است.
            </p>
        </div>
    @endif
</div>
