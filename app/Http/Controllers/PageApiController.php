<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\PageModel;

class PageApiController extends Controller
{
    /**
     * API: Get 
     * 
     * @param Request $request
     * @return JSON
     */
    public function get(Request $request)
    {
        return response()->json(PageModel::get(), 200);
    }
}
