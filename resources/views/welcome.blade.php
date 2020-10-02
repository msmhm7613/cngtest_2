@extends ('layouts.head')

@section ( 'content' )

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="cart">
                <div class="cart-header">
                     سیستم رهگیری قطعات شهاب خودرو
                </div>
                <div class="cart-body">
                    @guest
                        <a href="login" class="btn btn-primary">
                            ورود
                        </a>
                    @endguest
                </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>

@endsection
