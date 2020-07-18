<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Functie voor de constructor
     */
    public function __construct()
    {
        // check voor gebruikers rol
    }


    /**
     * Functie voor het ophalen van de dahsboard
     * 
     * @return Illuminate\Http\Request
     */
    public function index()
    {
        $this->middleware('checkrole:1');

        return view("dashboard.dashboard");
    }
}
