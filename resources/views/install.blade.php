
@extends ( 'layouts.head' )

@section ( 'content' )
    <div class="wizard vh-100 d-flex justify-content-center align-center text-center ">
        <div class="row">
            <form action="SetupController" method="post">
                <div class="row header">
                    <img src=" {{ asset('images/logo.png') }} " alt="logo" class='logo'>
                    <h3>
                        نصب نرم‌افزار
                    </h3>
                    <p>
                        ما برای نصب نرم‌افزار به اطلاعات زیر نیاز داریم. این نصب فقط یک بار در هنگام شروع کار نرم‌افزار اجرا خواهد شد.
                    </p>
                    
                </div>
            </form>
        </div>
    </div>
@endsection