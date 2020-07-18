<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use DB;

use App\SettingsAlgemeenModel;
use App\SettingsSocialMediaModel;
use App\MenuModel;
use App\ModuleModel;
use App\ThemeModel;
use App\PageModel;
use App\MessageModel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /**
         * 
         */
        $theme = ThemeModel::where('selected', 1)->get()->first();


        /**
         * View voor de master layout
         */
        view()->composer('layouts.master', function($view) {
            $algemeen = SettingsAlgemeenModel::get()->pluck('value', 'name');
            $socialmedia = SettingsSocialMediaModel::get()->pluck('value', 'name');

            $modules = ModuleModel::get();
            $messages = MessageModel::where('read', 0)->orderby('time')->get();

            $view->with(compact('algemeen', 'socialmedia', 'modules', 'messages'));
        });


        /**
         * Data voor de theme read 
         */
        view()->composer('theme.read', function($view) {
            $algemeen = SettingsAlgemeenModel::get()->pluck('value', 'name');

            $view->with(compact('algemeen'));
        });


        /**
         * 
         */
        view()->composer('auth.login', function ($view) {
            $algemeen = SettingsAlgemeenModel::get()->pluck('value', 'name');

            $view->with(compact('algemeen'));
        });


        /**
         * Alle gegevens voor de meta data file
         */
        view()->composer('partials.meta', function($view) {
            $algemeen = SettingsAlgemeenModel::get()->pluck('value', 'name');
            $socialmedia = SettingsSocialMediaModel::get()->pluck('value', 'name');



            $view->with(compact('algemeen', 'socialmedia'));
        });


        /**
         * Register settings in master van template
         */
        view()->composer('templates.'.strtolower($theme->name).'.master', function($view) {
            $algemeen = SettingsAlgemeenModel::get()->pluck('value', 'name');
            $socialmedia = SettingsSocialMediaModel::get()->pluck('value', 'name');

            $view->with(compact('algemeen', 'socialmedia'));
        });


        /**
         * Register menu in menu van template
         */
        view()->composer('templates.'.strtolower($theme->name).'.partials.menu', function($view) {
            $menus = MenuModel::get()->where('active', 1);

            $current_route = Route::current()->parameter('page_name');

            $view->with(compact('menus'));
        });


        /**
         * Register page data in de pagina's 
         */
        view()->composer('partials.meta', function($view) {
            $array_page = [];
            $array_module = [];
            foreach (PageModel::get() as $key => $value) {
                $array_page[$value->view] = $value->name;
            }
            $current_route = Route::current()->parameter('page_name');
            $home_data = DB::table('page_'.$array_page[$current_route])->where('id', 1)->get()->first();
            $module_data = $array_module;

            $view->with(compact('home_data', 'module_data'));
        });
    }
}
