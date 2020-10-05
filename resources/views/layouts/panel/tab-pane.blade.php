<ul class="nav nav-tabs">
    @if(in_array(Auth::user()->role,array(1,2)))
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#users">
                <i class="fas fa-users ml-2"></i>
                کاربران
            </a>
        </li>
    @endif
    @if(in_array(Auth::user()->role,array(1,5)))
        <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#kits">
                <i class="fas fa-store ml-2"></i>
                انبار موقت
            </a>
        </li>
    @endif
    @if(in_array(Auth::user()->role,array(1,6)))
        <li class="nav-item">
            <a class="nav-link " data-toggle="tab" href="#workshops">
                <i class="fas fa-wrench ml-2"></i>
                کارگاه
            </a>
        </li>
    @endif
  </ul>
