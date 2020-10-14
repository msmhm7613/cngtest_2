@guest
    return redirect('login');
@endguest
@include ('store.header' )

<div class="content my-4">
    @if (App\Models\Store::all()->count())
        {{ $ind = 0 }}
        {{ $stores = App\Models\Store::all() }}

        <table class="table table-stripped">
            <tr>
                <th>ردیف</th>
                <th>نام انبار</th>
                <th>نام مسئول</th>
                <th>تلفن</th>
                <th>موبایل</th>
                <th>آدرس</th>
                <th>توضیحات</th>
            </tr>
            @foreach ($stores as $store)
                {{ $user = App\Models\User::with($user->id) }}
                {{ $creator_user = App\Models\User::with($user->creator_user_id) }}
                <tr>
                    <td>{{ $ind++ }}</td>
                    <td>{{ $store->name }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $store->phone }}</td>
                    <td>{{ $store->mobile }}</td>
                    <td>{{ $store->address }}</td>
                    <td>{{ $store->created_at }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p class="alert alert-info">
            هنوز هیچ انباری تعریف نشده است.
        </p>
    @endif
</div>


@include ( 'store.footer' )
