@guest

    <script>
        window.location('login')

    </script> ;
@endguest

@include('stuff.header')

@if (App\Models\Stuff::all()->count())

@else
    <div class="mt-3 alert alert-info">
        هنوز هیچ کالایی ثبت نشده است.
    </div>
@endif
@include('stuff.footer')
