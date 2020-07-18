<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MenuModel;
use App\PageModel;

class MenuController extends Controller
{
    /**
     * Constructor
     */
    public function __construct()
    {
        // 
    }


    /**
     * Functie voor het ophalen van de read
     * 
     * @return 
     */
    public function index()
    {
        $menu_inactive = MenuModel::get()->where('active', 0);
        $menu_active = MenuModel::get()->where('active', 1);
        $pages = PageModel::get();

        return view('menu.read', compact('menu_inactive', 'menu_active', 'pages'));
    }


    /**
     * Functie voor het opslaan van de gegevens
     * 
     * @param Request $request;
     * @return Illuminate\Http\Request redirect;
     */
    public function store(Request $request)
    {
        MenuModel::truncate();

        foreach ($request->request as $key => $value) {
            if (!empty($value) && is_array($value)) {
                foreach ($value as $val) {
                    if (isset($val['name']) && isset($val['slug']) && isset($val['pages']) && isset($val['sub_menu']) && isset($val['order']) && isset($val['active'])) {
                        MenuModel::create([
                            'name' => $val['name'],
                            'slug' => $val['slug'],
                            'page_id' => $val['pages'],
                            'sub_menu' => $val['sub_menu'],
                            'order' => $val['order'],
                            'active' => $val['active'],
                        ]);
                    } else {
                        break;
                    }
                }
            } else {
                break;
            }
        }
        
        return redirect('/admin/menu')->with('status', 'Menu item succesvol aangemaakt');
    }
}
