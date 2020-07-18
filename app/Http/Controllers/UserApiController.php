<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserApiController extends Controller
{
    /**
     * @var User $_user
     */
    private $_email;


    /**
     * Functie voor het ophalen van data
     * 
     * @return JSON 
     */
    public function get(Request $request)
    {
        if (!empty($request->all())) {
            $input = $request->all();
            return response()->json(User::where('email', $input['email'])->get()->first(), 200);
        } else {
            return response()->json(User::get(), 200);
        }
    }


    /**
     * Functie voor het versturen van de user data
     * 
     * @param Request $request
     * @return 
     */
    public function post(Request $request)
    {
        if (!empty($request)) {
            $input = $request->all();
            $this->_email =  $input['email'];
            return response()->json(['msg' => 'success'], 200);
        } else {
            return response()->json(['error' => 'data niet ontvangen'], 401);
        }
    }
}
