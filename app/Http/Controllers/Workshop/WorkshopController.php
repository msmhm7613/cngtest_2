<?php

namespace App\Http\Controllers\Workshop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class WorkshopController extends Controller
{
    public function insert(Request $request)
    {
        $rules      = [

            'name'          => ['unique', 'required', 'min:3', 'max:25', 'string'],
            'manager'       => ['min:3', 'max:25', 'string'],
            'contractor_id' => ['required', 'numeric'],
            'phone'         => ['nullable', 'string', 'min:3', 'max:8'],
            'mobile'        => ['nullable', 'string', 'min:11', 'max:11'],
            'address'       => ['nullable', 'string', ],
            'user_id'       => ['required', 'numeric'],

        ];
        $validator  = Validator::make();
    }

    public function loadInsertForm(Request $request)
    {
        return view('layouts.modals.workshop.insert',['r' => $request->r]);
    }
}
