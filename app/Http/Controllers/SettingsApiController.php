<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\SettingsAlgemeenModel;

class SettingsApiController extends Controller
{
    /**
     * Functie voor het ophalen van data
     * 
     * @return JSON 
     */
    public function get(Request $request)
    {
        return response()->json(SettingsAlgemeenModel::get()->pluck('value', 'name'));
    }
}
