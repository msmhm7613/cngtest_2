
@php
    use App\Models\Workshop as workshop;
    use App\Models\User     as user;
@endphp

<div class="tab-pane" id="workshop-table">
    <h3 class="text-center">
        <i class="fas fa-wrench"></i>
        کارگاه
    </h3>
    @if(in_array(Auth::user()->role, [1,6] ))
    <button class="btn btn-success" id="insert-new-workshop-modal-btn">
        <i class="fas fa-plus"></i>
        کارگاه جدید
    </button>
    @endif
    @if(workshop::all()->count())
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
        @foreach ( workshop::all() as $workshop )
            <tr>
                <td>
                    {{ $ind }}
                </td>
                <td>
                    {{ $workshop->serial }}
                </td>
                <td>
                    <div class="d-flex justify-content-between">
                        <p>
                            @if ( $workshop->status )
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
                            @if ( $workshop->pack_status )
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
    @else
    <div id="content" class="ajax-content mt-3">
        <div class="alert alert-info" >
            <p>
                هیچ کارگاهی ثبت نشده است.
            </p>
        </div>
    </div>

    @endif
</div>
