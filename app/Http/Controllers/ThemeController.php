<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\ThemeModel;
use App\MessageModel;


class ThemeController extends Controller
{
    /**
     * @var Carbon $_date
     */
    protected $_date;


    /**
     * @var String $_path;
     */
    private $_path;

    /**
     * Constructor
     */
    public function __construct() {
        $this->_date = Carbon::now();
        $this->_path = resource_path('views/templates/');
    }


    /**
     * Functie om de read pagina op te halen
     * 
     * @return Illuminate\Http\Request view;
     */
    public function index()
    {
        $themes = ThemeModel::get();

        return view('theme.read', compact('themes'));
    }

    
    /**
     * Functie om de create pagina op te halen
     * 
     * @param
     * @return Illuminate\Http\Request view;
     */
    public function create()
    {
        return view('theme.create');
    }


    /**
     * Functie om een thema aan te maken
     * 
     * @param Illuminate\Http\Request $request;
     * @return Illuminate\Http\Request view;
     */
    public function store(Request $request)
    {
        $this->createFolderStructure($request);

        ThemeModel::create($this->transformForm($request));
        $this->createMessage(['Succes', 'Thema succesvol aangemaakt', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(),]);
        return redirect('/admin/theme')->with('status', 'Thema succesvol aangemaakt!');
    }


    /**
     * Functie voor het laten zien van de template details
     * 
     * @param ThemeModel $theme
     * @return Illuminate\Http\Request view;
     */
    public function detail(ThemeModel $theme)
    {
        return view('theme.detail', compact('theme'));
    }


    /**
     * Functie om de theme te verwijderen
     * 
     * @param ThemeModel $theme
     * @return  Illuminate\Http\Request redirect
     */
    public function delete(ThemeModel $theme)
    {
        $this->deleteFolderStructure($theme);

        $theme->delete();
        $this->createMessage(['Succes', 'Template succesvol verwijderd', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(),]);
        return redirect('/admin/theme')->with('status', 'Theme succesvol verwijderd');
    }


    /**
     * Functie om de folder structuur aan de disk toe te voegen 
     * 
     * @param Request $request
     * @return void
     */
    private function createFolderStructure(Request $request)
    {
        File::makeDirectory(resource_path('views/templates/'.$request->input('name')));
        File::makeDirectory(resource_path('views/templates/'.$request->input('name').'/controllers'));
        File::makeDirectory(resource_path('views/templates/'.$request->input('name').'/css'));
        File::makeDirectory(resource_path('views/templates/'.$request->input('name').'/js'));
        File::makeDirectory(resource_path('views/templates/'.$request->input('name').'/models'));
        File::makeDirectory(resource_path('views/templates/'.$request->input('name').'/pages'));
        File::makeDirectory(resource_path('views/templates/'.$request->input('name').'/partials'));
    }


    /**
     * Functie voor het verwijderen van de foider
     * 
     * @param ThemeModel $theme
     * @return File
     */
    private function deleteFolderStructure(ThemeModel $theme)
    {
        File::deleteDirectories(resource_path('views/templates/'.$theme->name));
        return File::deleteDirectory(resource_path('views/templates/'.$theme->name));
    }


    /**
     * Functie voor het aanmaken van een melding
     * 
     * @param array $data
     * @return MessageModel 
     */
    private function createMessage(array $data)
    {
        return MessageModel::create([
            'name' => $data[0],
            'message' => $data[1],
            'image' => $data[2],
            'read' => $data[3],
            'date' => $data[4],
            'time' => $data[5],
        ]);
    }


    /**
     * Standaard array
     * 
     * @return Array
     */
    private function transformForm($request)
    {
        return [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'author' => $request->input('author'),
            'company' => $request->input('company'),
            'lisence' => $request->input('lisence'),
            'selected' => $request->input('selected'),
        ];
    }
}
