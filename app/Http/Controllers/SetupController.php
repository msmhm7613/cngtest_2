<?php

namespace App\Http\Controllers;

use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use PDOException;

class SetupController extends Controller
{
    protected function index(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'dbname'        => ['string', 'required', 'min:3', 'max:25'],
            'dbusername'    => ['string', 'required', 'min:3', 'max:25'],
            'dbpassword'    => ['string', 'max:25', 'nullable'],
            'dbport'        => ['numeric'],
        ]);


        if ($validator->fails()) {
            die(dd($validator->getMessageBag()));
        }

        if (!env('DB_INSTALLED', 0)) {
            $this->setupDB($request);
        }
        return view('new-panel');
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

    public function setupDB(Request $request)
    {
            Config::set('database.connections.mysql.database', $request->dbname);
            Config::set('database.connections.mysql.username', $request->dbusername);
            Config::set('database.connections.mysql.port', $request->dbport);
            Config::set('database.connections.mysql.password', $request->dbpassword);

            Artisan::call('migrate:fresh');

            $this->updateDotEnv('DB_INSTALLED'  , 1);
            $this->updateDotEnv('DB_PORT'       , $request->dbport);
            $this->updateDotEnv('DB_DATABASE'   , $request->dbname);
            $this->updateDotEnv('DB_USERNAME'   , $request->dbusername);
            $this->updateDotEnv('DB_PASSWORD'   , $request->dbpassword);

    }
}
