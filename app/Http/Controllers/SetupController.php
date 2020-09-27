<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetupController extends Controller
{
    public function index(Request $request)
    {
        if ( env('DB_INSTALLED' , 0 ))
            $data = 'DB_INSALLED';
        else
            $data = 'DB_NOT_INSTALLED';

        request()->validate([
            'dbname' => ['required','string','max:5']
        ]);
        
        return 'I get it - ' . ' - '. $data.' - ';
    }

    public function CheckDB()
    {

    }
    protected function updateDotEnv($key, $newValue, $delim = '')
    {

        $path = base_path('.env');
        // get old value from current env
        $oldValue = env($key);

        // was there any change?
        if ($oldValue === $newValue) {
            return;
        }

        // rewrite file content with changed data
        if (file_exists($path)) {
            // replace current value with new value
            file_put_contents(
                $path,
                str_replace(
                    $key . '=' . $delim . $oldValue . $delim,
                    $key . '=' . $delim . $newValue . $delim,
                    file_get_contents($path)
                )
            );
        }
    }
}
