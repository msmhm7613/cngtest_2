{{--**************************************************--}}
{{--**************************************************--}}
{{--**************************************************--}}


<div class="menu">
    <ul class="nav nav-tabs" id="panel-tabs">
        @foreach ($data['btns'] as $btn)
            <li class="nav-item">
                <a class="nav-link " data-toggle="tab" href="{{ $btn['url'] }}">
                    <i class="fas fa-{{ $btn['icon'] }} ml-2"></i>
                    {{ $btn['text'] }}
                </a>
            </li>
        @endforeach
    </ul>
</div>



{{--**************************************************--}}
{{--**************************************************--}}
{{--**************************************************--}}

<div class="tab-content">
    @foreach ($data['btns'] as $btn)
        <?php

        $active = 'active';

        if ($btn['active'] == 1) {
        $active = 'active';
        } elseif ($btn['active'] == 2) {
        $active = 'fade';
        } else {
        $active = '';
        }
        ?>
        <div class="tab-pane {{ $active }}" id="{{ $btn['url'] }}">
            {{$btn['text']}}
        </div>
    @endforeach
</div>
