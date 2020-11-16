@include('workshop.workshop-header')
@php

$tempstores = \App\Models\Tempstore::all();
@endphp
@if ($tempstores->count() === 0)
    <div class="row">
        <div class="alert alert-info">
            {{ ' هــیچ کارگــاهی ثـبت نـشده اسـت . ' }}
        </div>
    </div>
@else
    <?php $ind = 1; ?>
    <table class="table table-bordered" id="workshops-table">

        <thead>
            <tr class="table-primary">
                <th>
                    ردیف
                </th>
                <th>
                    کد کارگاه
                </th>
                <th>
                    نام کارگاه
                </th>
                <th>
                    نام مدیر
                </th>
                <th>
                    تلفن
                </th>
                <th>
                    موبایل
                </th>
                <th>
                    آدرس
                </th>
                <th>
                    توضیحات
                </th>
                <th>
                    عملیات
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tempstores as $tempstore)
                <tr>
                    <td>
                        {{ $ind++ }}
                    </td>
                    <td>
                        {{ $tempstore->code }}
                    </td>
                    <td>
                        {{ $tempstore->name }}
                    </td>
                    <td>
                        {{ $tempstore->manager }}
                    </td>
                    <td>
                        {{ $tempstore->phone }}
                    </td>
                    <td>
                        {{ $tempstore->mobile }}
                    </td>
                    <td>
                        {{ $tempstore->address }}
                    </td>
                    <td>
                        {{ $tempstore->description }}
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="table-primary">
                <th>
                    ردیف
                </th>
                <th>
                    کد کارگاه
                </th>
                <th>
                    نام کارگاه
                </th>
                <th>
                    نام مدیر
                </th>
                <th>
                    تلفن
                </th>
                <th>
                    موبایل
                </th>
                <th>
                    آدرس
                </th>
                <th>
                    توضیحات
                </th>
                <th>
                    عملیات
                </th>
            </tr>
        </tfoot>
    </table>
@endif
@include('workshop.insert-new-workshop-modal')

<script src="{{ asset('js/workshop/insert-new-workshop.js') }}"></script>