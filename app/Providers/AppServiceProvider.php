<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Exception;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Try do define all subdirectorie in migratios directory
        try {
            $mainPath = database_path('migrations');
            $directories = glob($mainPath . '/*', GLOB_ONLYDIR);
            $paths = array_merge([$mainPath], $directories);
        } catch (Exception $ex) {
            return response()->json(['errors' => [$ex->getMessage()]]);
        }

        $this->loadMigrationsFrom($paths);
    }
}
