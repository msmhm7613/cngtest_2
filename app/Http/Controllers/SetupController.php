<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Dotenv;
use Dotenv\Dotenv as DotenvDotenv;
use Egulias\EmailValidator\Exception\DotAtStart;
use Illuminate\Support\Env;
use Illuminate\Support\Facades\Artisan;
use App\Models\User;
use CreateUsersTable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class SetupController extends Controller
{
    protected function index(Request $request)
    {
        $this->validate($request, [
            'dbname'        => 'required|min:3|max:25|string',
            'dbusername'    => 'required|min:3|max:25|string',
            'dbpassword'    => 'max:25|string|nullable',
            'dbport'        => 'required|numeric|', // TODO: check for length of port number

        ]);

        $this->setupDB($request);
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

    private function setupDB(Request $request)
    {
        try {


            Config::set('database.connections.mysql.database', $request->dbname);
            Config::set('database.connections.mysql.username', $request->dbusername);
            Config::set('database.connections.mysql.port', $request->dbport);
            Config::set('database.connections.mysql.password', $request->dbpassword);

            /*             $_ENV['DB_DATABASE'] = $request->dbname;

            Artisan::call('view:clear'); */

            echo '<br><br>Database Configuration completed.';

            if (!Schema::hasTable('users')) {
                Artisan::call('migrate');
                echo '<br><br>Table created.';

                $newUsers = ['admin', 'itman', 'peymankar', 'anbar', 'anbarm', 'kargah'];
                foreach ($newUsers as $newUser) {
                    User::create(
                        [
                            'username' => $newUser,
                            'password' => $newUser,
                            'role'      => array_search($newUser, $newUsers) + 1,
                        ]
                    );
                    echo '<br><br><b style="color:green;">User insetrted into table.</b><br>';
                }

            }


                $user = User::where('role',1)->first();
                Auth::login($user);

                echo 'You are logged in as : '. $user->username ;

            return;
        } catch (Exception $ex) {
            echo '<br><br>Error: ' . $ex->getMessage();
            return;
        }
    }
}
