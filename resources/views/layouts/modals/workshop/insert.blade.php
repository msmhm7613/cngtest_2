<?php
    use App\Models\Workshop as workshop;
    use App\Models\Contractor as contractor;
?>

                @if(contractor::all()->count() < 1)
                    <div class="alert alert-warning" >
                        <p>
                            <i class="fas fa-exclamation-triangle"></i>
                            {{ __('باید حداقل یک پیمانکار داشته باشید') }}
                            <strong>
                                {{ $r }}
                            </strong>
                        </p>

                        {{-- <a href="/panel#contractor-table" class="btn btn-primary btn-sm" data-toggle="#contractor-table">
                            ایجاد پیمانکار
                        </a> --}}

                    </div>
                    <?php return; ?>
                @endif
                <form action="" method="POST" class="form-horizontal" id="insert-workshop-form">
                    @csrf
                    <div class="form-group row add">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class="inset" placeholder="نام کارگاه" id="name" name="name">
                                @error('name')
                                    <small id="small-1">
                                        {{ $message }}
                                    </small>
                                @enderror

                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" autofocus class=" inset" placeholder="نام مسئول" id="manager" name="manager">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select name="contractor" id="contractor" class="form-control">

                                    @foreach(App\Models\Contractor::all() as $contractor)
                                        <option>
                                            {{ $contractor->name }}
                                        </option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
