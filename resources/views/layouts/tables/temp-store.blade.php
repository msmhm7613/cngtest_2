@php
    use App\Models\User as user;
    use App\Models\Kit as kit;
@endphp

<div class="tab-pane" id="temp-store-table">
        <h3 class="text-center">
            <i class="fas fa-store"></i>
            انبار موقت
        </h3>
        @if(in_array(Auth::user()->role, [1,5] ))
        <button class="btn btn-success" id="new-temp-modal-opener-btn">
            <i class="fas fa-plus"></i>
            انبار موقت جدید
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
