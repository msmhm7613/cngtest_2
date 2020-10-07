@if( ! ( in_array ( Auth::user()->role, [ 1, 2 ] ) ) )
{{ 'عدم دسترسی' }}
@else
<div class="menu">
    <ul class="nav nav-tabs" id="panel-tabs">

        <li class="nav-item" data-active="user">
            <a class="nav-link active" data-toggle="tab" href="#users">
                <i class="fas fa-users ml-2"></i>
                کاربران
            </a>
        </li>
        <li class="nav-item" data-active="tempstore">
            <a class="nav-link " data-toggle="tab" href="#temp-store-table">
                <i class="fas fa-store ml-2"></i>
                انبار موقت
            </a>
        </li>
        <li class="nav-item" data-active="store">
            <a class="nav-link " data-toggle="tab" href="#store-table">
                <i class="fas fa-car ml-2"></i>
                انبار
            </a>
        </li>
        <li class="nav-item" data-active="contractor">
            <a class="nav-link " data-toggle="tab" href="#contractor-table">
                <i class="fas fa-car ml-2"></i>
                پیمانکار
            </a>
        </li>
        <li class="nav-item" data-active="workshop">
            <a class="nav-link " data-toggle="tab" href="#workshop-table">
                <i class="fas fa-wrench ml-2"></i>
                کارگاه
            </a>
        </li>
    </ul>
</div>
@endif
