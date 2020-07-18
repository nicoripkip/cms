<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use View;

use App\PageModel;
use App\ThemeModel;
use App\SettingsAlgemeenModel;
use App\SettingsSocialMediaModel;
use App\MenuModel;

class FrontendController extends Controller
{
    /**
     * @var PageModel $page_data
     */
    protected $page_data;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->page_data = PageModel::get();
    }


    /**
     * Functie voor het ophalen van de welcome blade
     * 
     * @return Illuminate\Http\Request view;
     */
    public function index()
    {
        return redirect('/home');
    }


    /**
     * Functie voor et regelen van de pagina's
     * 
     * @param String $page_name;
     * @return Illuminate\Http\Request;
     */
    public function pages($page_name)
    {
        $theme = $this->getThemesBySelected(1);
        $this->registerPageData($page_name, $theme, 'vogelhuisje');
        
        if (in_array($page_name, $this->objectToArray('name'))) {
            return view('templates.'.strtolower($theme->name).'.pages.'.$page_name)->with(compact('theme'));
        } else {
            return view('templates.'.strtolower($theme->name).'.partials.404')->with(compact('theme'));;
        }
    }


    /**
     * Functie voor het laten zien van gedetaileerde pagina's
     * 
     * @param 
     * @param 
     * @return 
     */
    public function detail(string $page_name, string $detail)
    {
        $page_array = $this->objectToArray('name');
        $theme = $this->getThemesBySelected(1);

        $array = [
            'vogelhuisjes' => 'vogelhuisje',
        ];

        if (in_array($page_name, $page_array)) {
            if ($detail) {
                $module_data = DB::table('module_'.$array[$page_name])->where('slug_url', $detail)->get()->first();
                return view('/templates/'.strtolower($theme->name).'/pages/'.$page_name.'_detail')->with(compact('theme', 'module_data'));
            }
            return view('/templates/'.strtolower($theme->name).'/pages/'.$page_name)->with(compact('theme'));
        } else {
            return view('templates.'.strtolower($theme->name).'.partials.404')->with(compact('theme'));;
        }
    }


    /**
     * 
     */
    public function getThemesBySelected($selected)
    {
        return ThemeModel::get()->where('selected', $selected)->first();
    }

    /**
     * funtie voor het ophalen van module data
     * 
     * @param String $name;
     * @return 
     */
    private function getModuleDataByName(string $name)
    {
        return DB::table('module_'.$name)->get();
    }


    /**
     * Functie van het omvormen van object naar array
     * 
     * @param String $parameter;
     * @return array 
     */
    private function objectToArray($parameter)
    {
        $object = PageModel::get($parameter);
        $x = [];
        foreach ($object as $value) {
            array_push($x, strtolower($value->name));
        }
        return $x;
    }


    /**
     * Functie voor het registreren van de pagina data
     * 
     * @param String $view_name
     * @param ThemeModel $theme
     * @param String $module_name
     * @return null
     */
    private function registerPageData($view_name, $theme, $module_name = "") {
        view()->composer('templates.'.strtolower($theme->name).'.pages.'.$view_name, function($view) use ($view_name, $module_name) {
            $array_page = [];
            $array_module = [];
            foreach (PageModel::get() as $key => $value) {
                $array_page[$value->view] = $value->name;
            }

            $home_data = DB::table('page_'.$array_page[$view_name])->where('id', 1)->get()->first();
            if ($module_name != "") {
                $module_data = $this->getModuleDataByName($module_name);
            } else {
                $module_data = "";
            }
            

            $view->with(compact('home_data', 'module_data'));
        });
    }
}
