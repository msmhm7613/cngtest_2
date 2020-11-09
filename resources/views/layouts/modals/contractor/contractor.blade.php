@php
    use App\Models\Contractor as contractor ;
    use App\Models\User as user;
    use App\Models\Kit as kit;
@endphp

<div class="tab-pane" id="contractor-table">
        <h3 class="text-center">
            <i class="fas fa-store"></i>
            پیمانکار
        </h3>

        @if(in_array(Auth::user()->role, [1] ))
        <button class="btn btn-success" id="insert-new-contractor-form-show-btn">
            <i class="fas fa-plus"></i>
            پیمانکار جدید
        </button>
        @endif

        @if(contractor::all()->count())
        <table class="table table-striped tbl-contractors">
            <tr>
                <th>ردیف</th>
                <th>شناسه</th>
                <th>نام</th>
                <th>مدیر</th>
                <th>توضیحات</th>
            </tr>
            @php
                $ind = 1;
            @endphp
            @foreach ( contractor::all() as $contractor )
                <tr>
                    <td>
                        {{ $ind }}
                    </td>
                    <td>
                        {{ $contractor->id }}
                    </td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <p>
                                {{ $contractor->name??"*" }}
                            </p>

                        </div>
                    </td>
                    <td >
                        <div class="d-flex justify-content-between">
                            <p>
                                {{ $contractor->description??"*" }}
                            </p>
                         </div>
                    </td>

                    <td class="text-left operation" >
                        @if(in_array(Auth::user()->role , [1]))
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
                        @endif
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
                هیچ پیمانکاری ثبت نشده است.
            </p>
        </div>
        @endif
    </div>
