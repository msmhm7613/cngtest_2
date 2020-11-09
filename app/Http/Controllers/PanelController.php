<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use JsonException;

class PanelController extends Controller
{
    public function index(Request $request)
    {

        if (Auth::guest())
            return redirect('/');
        if (isset($request->activeTab)) {

            $variable = strval($request->activeTab);
            $response = [
                'target'    => $variable,
                'text'      => $variable,
            ];

            switch ($variable) {
                case '#users':
                    $response['text'] = view('layouts.tables.users')->render();
                    return $response;
                    break;

                default:
                    return $response;
                    break;
            }
        }
        return view('panel', ['msg' => date("G:i:s:m")]);
    }

    public function init(Request $request)
    {
        return view('new-panel');
        /* try {

            $btns = $request->all();

            $data = [
                'icon'      => 'users',
                'title'     => 'کاربر',
                'btns'      => $btns,
            ];

            $html = (view('layouts.tabcontent.header', compact('data'))->render());
            return $html;
        } catch (Exception $ex) {
            return response()->json(['errors' => $ex->getMessage()]);
        } */
    }
}
