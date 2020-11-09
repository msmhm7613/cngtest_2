@if((App\Models\Workshop::all()->count()) < 1)
<div class="alert alert-info mt-5">
    <p>
        هیچ کارگاهی ثبت نشده است.
    </p>
</div>
<?php return false; ?>
@endif
