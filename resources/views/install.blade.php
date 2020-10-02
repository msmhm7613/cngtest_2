@extends ( 'layouts.head' )

@section ( 'content' )

<?php use illuminate\Http; ?>

<div class="wizard outset">


        <div class="row">
            <div class="col header">
                <img src=" {{ asset('images/logo.png') }} " alt="logo" class='logo'>
                <h3>
                    نصب نرم‌افزار
                </h3>
                <p>
                    ما برای نصب نرم‌افزار به اطلاعات زیر نیاز داریم. این نصب فقط یک بار در هنگام شروع کار نرم‌افزار اجرا خواهد شد.
                </p>
            </div>

        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <form action="setup" method="post" class="form">
                <div class="row">
                    <div class="col">
                        <fieldset>
                            <legend>Database</legend>
                            <div class="form-group">
                                <input type="text" name="dbname" id="dbname" placeholder="Database Name" class=" inset eng"
                                value="{{ old('dbname') }}"
                                >
                                @error('dbname')
                                    <small class="error">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" name="dbusername" id="dbusername" placeholder="Database Username" class=" inset eng"
                                value="{{ old('dbusername') }}">
                                @error('dbusername')
                                <small class="error">
                                    {{ $message }}
                                </small>
                            @enderror
                            </div>

                            <div class="form-group" id="dbpass">
                                <input type="password" name="dbpassword" id="dbpassword" placeholder="Database Password" class=" inset eng eye"
                                value="{{ old('dbpassword')?old('dbpassword'):'' }}"
                                >
                                <i class="fas fa-eye" id="eye" ></i>
                                @error('dbpassword')
                                <small class="error">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" name="dbport" id="db-port" placeholder="Database Port" class=" inset eng"
                                value="{{ old('dbport')?old('dbport'):'8889' }}"
                                >
                                @error('dbport')
                                    <small class="error">
                                        {{ $message }}
                                    </small>
                                @enderror
                            </div>

                        </fieldset>
                    </div>
                </div>

                @csrf
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Next" class="form-control submit outset">
                    </div>
                </div>
            </form>
        </div>
</div>

<script>
    const eye = document.getElementById('eye')
    const dbpass = document.querySelector('#dbpass #dbpassword')
    eye.addEventListener('click',toggle)
    function toggle(e){
        if ( eye.classList.contains('fa-eye'))
        {
            eye.classList.toggle('fa-eye-slash')
            if ( dbpass.type === 'password' )
                dbpass.type = 'text'
            else
                dbpass.type = 'password'
        }

    }
</script>
@endsection
