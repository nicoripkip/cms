<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();  

// Alle prefixen van het CMS
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function() {

        // Dashboard controller
        Route::get('/', 'DashboardController@index')->name('index');


        // Menu - pagina
        Route::get('/menu', 'MenuController@index')->name('menu.index');
        Route::post('/menu/store', 'MenuController@store')->name('menu.store');
        Route::post('/menu/put/{$menu}', 'MenuController@put')->name('menu.put');
        Route::post('/menu/delete/{$menu}', 'MenuController@delete')->name('menu.delete');
        

        // Pagina - pagina
        Route::get('/page', 'PageController@index')->name('page.index');
        Route::get('/page/create', 'PageController@create')->name('page.create');
        Route::post('/page/create/store', 'PageController@store')->name('page.store');
        Route::get('/page/update/{page}', 'PageController@update')->name('page.update');
        Route::post('/page/update/put/{page}', 'PageController@put')->name('page.put');
        Route::get('/page/builder/{page}', 'PageController@builder')->name('page.builder');
        Route::post('/page/builder/save/{page}', 'PageController@save')->name('page.save');
        Route::post('/page/delete/{page}', 'PageController@delete')->name('page.delete');


        // Thema - pagina
        Route::get('/theme', 'ThemeController@index')->name('theme.index');
        Route::get('/theme/create', 'ThemeController@create')->name('theme.create');
        Route::post('/theme/create/store', 'ThemeController@store')->name('theme.store');
        Route::get('/theme/detail/{theme}', 'ThemeController@detail')->name('theme.detail');
        Route::get('/theme/update/{theme}', 'ThemeController@update')->name('theme.update');
        Route::post('/theme/update/put/{theme}', 'ThemeController@put')->name('theme.put');
        Route::post('/theme/delete/{theme}', 'ThemeController@delete')->name('theme.delete');


        // Variabele module
        Route::get('/ModuleItem/{module}', 'ModuleItemController@index')->name('moduleitem.index');
        Route::get('/ModuleItem/{module}/create', 'ModuleItemController@create')->name('moduleitem.create');
        Route::post('/ModuleItem/{module}/create/store', 'ModuleItemController@store')->name('moduleitem.store');
        Route::get('/ModuleItem/{module}/update/{item}', 'ModuleItemController@update')->name('moduleitem.update');
        Route::post('/ModuleItem/{module}/update/put/{item}', 'ModuleItemController@put')->name('moduleitem.put');
        Route::post('/ModuleItem/{module}/delete/{item}', 'ModuleItemController@delete')->name('moduleitem.delete');


        // Module - pagina
        Route::get('/module', 'ModuleController@index')->name('module.index');
        Route::get('/module/create', 'ModuleController@create')->name('module.create');
        Route::post('/modules/create/store', 'ModuleController@store')->name('module.store');
        Route::get('/modules/update/{module}', 'ModuleController@update')->name('module.update');
        Route::post('/modules/update/put/{module}', 'ModuleController@put')->name('module.put');
        Route::get('/modules/builder/{module}', 'ModuleController@builder')->name('module.builder');
        Route::post('/module/builder/save/{module}', 'ModuleController@save')->name('module.save');
        Route::post('/modules/delete/{module}', 'ModuleController@delete')->name('module.delete');


        // Templates - pagina
        Route::get('/template', 'TemplateController@index')->name('template.index');
        Route::get('/template/create', 'TemplateController@create')->name('template.create');
        Route::post('/template/create/store', 'TemplateController@store')->name('template.store');
        Route::get('/template/update/{template}', 'TemplateController@update')->name('template.update');
        Route::post('/template/update/put/{template}', 'TemplateController@put')->name('template.put');
        Route::get('/template/builder/{template}', 'TemplateController@builder')->name('template.builder');
        Route::post('/template/builder/save/{template}', 'TemplateController@save')->name('template.save');
        Route::post('/template/delete/{template}', 'TemplateController@delete')->name('template.delete');


        // Atribute - pagina
        Route::get('/attribute', 'AttributeController@index')->name('attribute.index');
        Route::get('/attribute/create', 'AttributeController@create')->name('attribute.create');
        Route::post('/attribute/create/store', 'AttributeController@store')->name('attribute.store');
        Route::get('/attribute/update/{attribute}', 'AttributeController@update')->name('attribute.update');
        Route::post('/attribute/update/put/{attribute}', 'AttributeController@put')->name('attribute.put');
        Route::post('/attribute/delete/{attribute}', 'AttributeController@delete')->name('attribute.delete');


        // Formulieren - pagina
        Route::get('/forms', 'FormsController@index')->name('forms.index');
        Route::get('/forms/create', 'FormsController@create')->name('forms.create');
        Route::post('/forms/create/store', 'FormsController@store')->name('forms.store');
        Route::get('/forms/update/{forms}', 'FormsController@update')->name('forms.update');
        Route::post('/forms/update/put/{forms}', 'FormsController@put')->name('forms.put');
        Route::post('/forms/delete/{forms}', 'FormsController@delete')->name('forms.delete');
        Route::get('/forms/builder/{forms}', 'FormsController@builder')->name('forms.builder');
        Route::post('/forms/builder/save/{forms}', 'FormsController@save')->name('forms.save');
        Route::get('/forms/export/{forms}', 'FormsController@export')->name('forms.export');


        // Mailen - pagina
        Route::get('/mails', 'MailController@index')->name('mails.index');
        Route::get('/mails/create', 'MailController@create')->name('mails.create');
        Route::post('/mails/create/store', 'MailController@store')->name('mails.store');
        Route::get('/mails/update/{mail}', 'MailController@update')->name('mails.update');
        Route::post('/mails/update/put/{mail}', 'MailController@put')->name('mails.put');
        Route::post('/mails/delete/{mail}', 'MailController@delete')->name('mails.delete');
        Route::get('/mails/builder/{mail}', 'MailController@builder')->name('mails.builder');
        Route::post('/mails/builder/save/{mail}', 'MailController@save')->name('mails.save');


        // Gebruikers - pagina
        Route::get('/user', 'UserController@index')->name('user.index');
        Route::get('/user/create', 'UserController@create')->name('user.create');
        Route::post('/user/create/store', 'UserController@store')->name('user.store');
        Route::get('/user/update/{id}', 'UserController@update')->name('user.update');
        Route::post('/user/update/put/{user}', 'UserController@put')->name('user.put');
        Route::post('/user/delete/{user}', 'UserController@delete')->name('user.delete');


        // Rechten - pagina
        Route::get('/role', 'RoleController@index')->name('role.index');
        Route::get('/role/create', 'RoleController@create')->name('role.create');
        Route::post('/role/create/store', 'RoleController@store')->name('role.store');
        Route::get('/role/update/{role}', 'RoleController@update')->name('role.update');
        Route::post('/role/update/put/{role}', 'RoleController@put')->name('role.put');
        Route::post('/role/delete/{role}', 'RoleController@delete')->name('role.delete');


        // Setting - pagina
        Route::get('/setting/{page}', 'SettingsController@index')->name('setting.index');
        Route::post('/setting/put/{page}', 'SettingsController@put')->name('setting.put');
});

// Alle prefixen van de voorkant 
Route::prefix('/')
    ->group(function () {
        Route::get('/', 'FrontendController@index');
        Route::get('/{page_name}', 'FrontendController@pages');
        Route::post('/{page_name}', 'FrontendController@pages');
        Route::get('/{page_name}/{detail}', 'FrontendController@detail');


        // Alle ajax requests
        Route::post('/ajax/post/createMailResult', function () {
            if (Request::ajax()) {
                $data = Request::except(['_token']);
                $form = App\FormsModel::where('name', $data['name'])->get()->first();
                DB::table('forms_'.$data['name'])->insert(Request::except(['name', '_token']));
                Mail::to($data['Email'], $data['Voornaam'])->send(new App\Mail\ResponseForm($data, $form->Mails->MailData));

                return response()->json(['msg' => 'Het werkt']);
            } else {
                return response()->json(['msg' => 'Het werkt niet'], 406);
            }   
        });

        Route::post('/ajax/post/updateMessage', function () {
            if (Request::ajax()) {
                $data = Request::except(['_token']);
                $message = App\MessageModel::find($data['id']);
                $message->update($data);
                return response()->json(['msg', 'Het werkt'], 200);
            }

            return response()->json(['msg' => 'Het werkt niet'], 406);
        });
});