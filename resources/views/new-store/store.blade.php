<div class="row">
    <div class="col-md-4">
        <div class="mycard outset">
            <div class="number">
                <h1>
                    <?php $stuffs = new App\Models\Stuff() ?>
                    {{ $stuffs->all()->count()}}
                </h1>
            </div>
            <div class="desc">
                تعداد کل کالا
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="mycard outset">
            <div class="number">
                <h1>
                    <?php $stuffpacks = new App\Models\Stuffpack() ?>
                    {{ $stuffpacks->all()->count()}}
                </h1>
            </div>
            <div class="desc">
                تعداد کل مجموعه کالا
            </div>
        </div>
    </div>
</div>
