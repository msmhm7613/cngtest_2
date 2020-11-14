<div class="bg-dark new-header text-light p-4">
        <div class="d-flex">
            <h3>
                {{ env('APP_NAME') }}
            </h3>
            <small title=" {{ $Version[1] }} " class="eng text-warning">
              
            </small>
        </div>
        <div class="version">
            <small class="small badge badge-pill badge-warning eng ">
                 {{-- {{  $Version[0]  }} --}}
                 {{ exec('git show --tags') }}
            </small>
            <small class="small" dir="ltr">
                <?php 
                   
                ?>
                
            </small>
            <small class="small">
                
            </small>
        </div>
</div>
