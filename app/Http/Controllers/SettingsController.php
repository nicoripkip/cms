<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\SettingsModel;
use App\SettingsAlgemeenModel;
use App\SettingsSocialMediaModel;

class SettingsController extends Controller
{
    /**
     * @var String $message;
     */
    private $message = 'Instellingen succesvol geupdated!';


    /**
     * Constructor
     */
    public function __construct()
    {
        $menu_item = 'active';
    }


    /**
     * Functie voor het ophalen van het read bestand
     * 
     * @param String $page;
     * @return Illuminate\Http\Request view;
     */
    public function index($page)
    {
        if ($page == 'algemeen') {
            $settings = SettingsAlgemeenModel::get()->pluck('value', 'name');
            return view('settings.'.$page, compact('settings'));
        }
        if ($page == 'socialmedia') {
            $media = SettingsSocialMediaModel::get()->pluck('value', 'name');
            return view('settings.'.$page, compact('media'));
        }
        if ($page == 'environment') {
            $files = $this->getFile('.env');

            $env_settings = explode("\n", $files);
            $env_settings = array_filter($env_settings, function($value) { return $value !== ''; });

            return view('settings.'.$page, compact('env_settings'));
        }
    }


    /**
     * Functie voor het opslaan van de settings
     *
     * @param Request $requet;
     * @param SettingsModel $settings;
     * @param Object $model;
     * @return Illuminate\Http\Request redirect;
     */
    public function put(Request $request, $page)
    {
        switch ($page) {
            // Algemene instellingen
            case "algemeen":
                SettingsAlgemeenModel::truncate();
                foreach ($request->settings as $key => $setting) {
                    if ($key == 'login_image' || $key == 'side_login' || $key == 'app_image') {
                        SettingsAlgemeenModel::create(['name' => $key, 'value' => $this->checkImage($setting)]);
                    }

                    SettingsAlgemeenModel::create($this->transformForm($key, $setting));
                }

                return redirect('/admin/setting/algemeen')->with('status', $this->message);
            break;
            // Social media
            case "socialmedia":
                SettingsSocialMediaModel::truncate();
                foreach ($request->settings as $key => $setting) {
                    SettingsSocialMediaModel::create($this->transformForm($key, $setting));
                }

                return redirect('/admin/setting/socialmedia')->with('status', $this->message);
            break;
            // Environment
            case "environment":
                $env_array = [];

                foreach ($request->settings as $key => $setting) {
                    $string = $key."=".$setting."\n";
                    array_push($env_array, $string);
                }
                $env_array = array_filter($env_array, function($value) { return !is_null($value) || !$value == ''; });
                $env_string = implode(" ", $env_array);
                $env_file = $this->getFile('.env');
                $this->writeFile('.env', $env_string);

                return redirect('/admin/setting/environment')->with('status', $this->message);
            break;
            // als er niks gevonden word
            default:
                return redirect('/admin/setting/algemeen');
            break;
        }
    }


    /**
     * Functie voor het ophalen van de files
     * 
     * @param String $file;
     * @return Illuminate\Support\Facades\Storage;
     */
    private function getFile(string $file)
    {
        if (File::exists(storage_path('../'.$file))) {
            return File::get(storage_path('../'.$file));
        } else {
            return redirect('/admin/setting/environment')->with('error', 'Geen {$file} file gevonden!');
        }
    }


    /**
     * Functie voor het schrijven van data naar een file
     * 
     * @param String $file;
     * @param String $content;
     * @return
     */
    private function writeFile(string $file, string $content)
    {
        if (File::exists(storage_path('../'.$file))) {
            File::replace(storage_path('../'.$file), $content);
        } else if (File::missing(storage_path('../'.$file))) {
            File::put(storage_path('../'.$file), $content);
        }
    }


    /**
     * Functie voor het verwijderen van de content van de file
     * 
     * @param String $file;
     * @return null
     */
    private function deleteFile(string $file)
    {
        if (File::exists('../'.$file)) {
            File::delete(storage_path('../'.$file));
        } else {
            return null;
        }
    }


    /**
     * Functie voor het verwerken van een afbeelding
     *
     * @param Request $request
     * @param User $user
     * @return string
     *
    */
    private function checkImage($setting)
    {
        if (is_null($setting)) {
            return null;
        }

        return $setting->store('media');
    }


    /**
     * Standaard array met de database waardes
     * 
     * @return Array;
     */
    private function transformForm($key, $value)
    {
        return [
            'name' => $key,
            'value' => $value,
        ];
    }
}
