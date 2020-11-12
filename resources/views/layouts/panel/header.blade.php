<div class="bg-dark new-header text-light p-4">
        <div class="d-flex">
            <h3>
                {{ env('APP_NAME') }}
            </h3>
            <small title=" {{ $Version[1] }} " class="eng text-warning">
               ({{  $Version[0]  }})
            </small>
        </div>
        <div class="version">
            <small class="small badge badge-pill badge-warning eng ">
                <?php echo trim(exec('git describe --tags --abbrev=3')); ?>
            </small>
            <small class="small" dir="ltr">
                <?php 
                    $gd = trim(exec('git --no-pager log -1 --format="%ai"'));
                    echo \Morilog\Jalali\Jalalian::forge($gd);
                ?>
                
            </small>
            <small class="small">
                kia
            </small>
        </div>
</div>
