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
use Illuminate\Support\Facades\Hash;

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

        if (!env('DB_INSTALLED', 0)) {
            $this->setupDB($request);

        }
        return redirect('panel');
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
                $title = [
                    'مدیر سایت',
                    'مسئول سایت',
                    'پیمانکار',
                    'انبار',
                    'انبار موقت',
                    'کارگاه',
                    'مهمان',
                ];
                foreach ($newUsers as $newUser) {
                    /* User::create(
                        [
                            'username' => strval($newUser),
                            'password' => Hash::make(strval($newUser)),
                            'role'      => array_search($newUser, $newUsers) + 1,
                            'title'    => $title[array_search($newUser,$newUsers)],
                        ]
                    ); */

                    $validate = Validator::make(
                        ['username' => $newUser, 'password' => $newUser, 'role' => 1, 'tilte'=> 'admin'],
                        [
                            'username' => ['required','min:5','max:30'],
                            'password' => ['required'],
                            'role'      => [''],
                            'title'     => ['']
                        ]
                    );

                    if ( $validate->fails())
                    {
                        var_dump($validate->errors()->all());
                        die();
                    }

                    $user = new User();
                    $user->username = $newUser;
                    $user->password = Hash::make('123456789');
                    $user->role = array_search($newUser,$newUsers) + 1;
                    $user->title = $title[array_search($newUser,$newUsers)];
                    $user->save();
                    echo '<br><br><b style="color:green;">User insetrted into table.</b><br>';
                }

            }

            $user = User::where('role', 1)->first();
            Auth::login($user);

            echo '<br><br>You are logged in as : ' . $user->username;

            $this->updateDotEnv('DB_INSTALLED', 1);
            $this->updateDotEnv('DB_PORT', $request->dbport);
            $this->updateDotEnv('DB_DATABASE', $request->dbname);
            $this->updateDotEnv('DB_USERNAME', $request->dbusername);
            $this->updateDotEnv('DB_PASSWORD', $request->dbpassword);
            return true;
        } catch (Exception $ex) {
            echo '<br><br>Error: ' . $ex->getMessage();
            return false;
        }
    }
}
