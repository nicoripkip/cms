<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

use App\TemplateModel;
use App\ThemeModel;
use App\AttributeModel;
use App\TemplateAttributesModel;
use App\MessageModel;


class TemplateController extends Controller
{
    /**
     * @var Carbon $_date
     */
    protected $_date;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_date = Carbon::now();
    }


    /**
     * Functie voor het ophalen van de read
     * 
     * @return Illuminate\Http\Request view;
     */
    public function index()
    {
        $templates = TemplateModel::get();

        return view('template.read', compact('templates'));
    }


    /**
     * Functie voor het ophalen van de create 
     * 
     * @return Illuminate\Http\Request view;
     */
    public function create()
    {
        $themes = ThemeModel::get()
                            ->where('selected', 1)
                            ->first();
        $blades = $this->getAllBladeFiles(strtolower($themes->name));
        return view('template.create', compact('blades'));
    }


    /**
     * Functie voor het opslaan van gegevens
     * 
     * @param Request $request;
     * @return Illuminate\Http\Request redirect;
     */
    public function store(Request $request)
    {
        TemplateModel::create($this->transformForm($request));
        $this->createMessage(['Succes', 'Template succesvol aangemaakt', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(),]);
        return redirect('/admin/template')->with('status', 'Template succesvol aangemaakt');
    }


    /**
     * Functie voor het ophalen van de updatepagina
     * 
     * @param TemplateModel $template;
     * @return Illuminate\Http\Request view;
     */
    public function update(TemplateModel $template)
    {
        $themes = ThemeModel::get()
                            ->where('selected', 1)
                            ->first();
        $blades = $this->getAllBladeFiles(strtolower($themes->name));

        return view('template.create', compact('blades', 'template'));
    }


    /**
     * Functie voor het opslaan van de template gegevens
     * 
     * @param TemplateModel $template;
     * @param Request $request;
     * @return Illuminate\Http\Request redirect;
     */
    public function put(Request $request, TemplateModel $template)
    {
        $template->update($this->transformForm($request));
        $this->createMessage(['Succes', 'Template succesvol geüpdated', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(),]);
        return redirect('/admin/template')->with('status', 'Template succesvol geupdated');
    }


    /**
     * Functie om de gegevens te deleten
     * 
     * @return Illuminate\Http\Request redirect;
     */
    public function delete(TemplateModel $template)
    {
        TemplateAttributesModel::where('template_id', $template->id)->delete();
        $template->delete();
        $this->createMessage(['Succes', 'Template succesvol verwijderd', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(),]);
        return redirect('/admin/template')->with('status', 'template succesvol verwijderd');
    }


    /**
     * Functie om de builder te starten
     * 
     * @param TemplateModel $template;
     * @return Illuminate\Http\Request view;
     */
    public function builder(TemplateModel $template)
    {
        $attributes_main = $this->getAttributeGroup('main', $template->id);
        $attributes_header = $this->getAttributeGroup('header', $template->id);
        $attributes_body = $this->getAttributeGroup('body', $template->id);
        $attributes_footer = $this->getAttributeGroup('footer', $template->id);

        $active_main = $this->getActiveAttributesByGroup('temlate_main', $template->id);
        $active_header = $this->getActiveAttributesByGroup('temlate_header', $template->id);
        $active_body = $this->getActiveAttributesByGroup('temlate_body', $template->id);
        $active_footer = $this->getActiveAttributesByGroup('temlate_footer', $template->id);

        return view('template.builder', compact(
                                            'template', 
                                            'attributes_main', 
                                            'attributes_header', 
                                            'attributes_body', 
                                            'attributes_footer',
                                            'active_main',
                                            'active_header',
                                            'active_body',
                                            'active_footer'
                                        ));
    }


    /**
     * 
     */
    public function save(Request $request, TemplateModel $template)
    {
        $this->deleteTemplatesAttributesById($template->id);
        foreach($request->request as $key => $value) {
            if (!empty($value) && is_array($value)){
                foreach($value as $val) {
                    if (isset($val['attribute_id']) && isset($val['bootstrap']) && isset($val['order']) && isset($val['active'])) {
                        TemplateAttributesModel::create([
                            'template_id' => $template->id,
                            'attribute_id' => $val['attribute_id'],
                            'group' => $key, 
                            'bootstrap' => $val['bootstrap'], 
                            'order' => $val['order'],
                            'active' => $val['active'],
                        ]);
                        AttributeModel::find($val['attribute_id'])->update(['used' => $val['used']]);
                    } else {
                        break;
                    }
                }
            } else {
            break;
            }
        }

        $this->createMessage(['Succes', 'Template succesvol aangemaakt', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(),]);
        return redirect('/admin/template')->with('status', 'Template succesvol aangemaakt');
    }


    /**
     * Fucntie voor attrributegroep
     * 
     * @param String $group;
     * @param Integer $id;
     * @return App\AttributeModel get;
     */
    private function getAttributeGroup(string $group, int $id) 
    {
        $array = [];
        $value = TemplateAttributesModel::where('template_id', $id)->where('active', 1)->get();
        foreach ($value as $val) {
            $array[] = $val->Attributes->name;
        }

        return AttributeModel::where('group', $group)->whereNotIn('name', $array)->get();
    }


    /**
     * Functie voor het ophalen van 
     * active attributen by groep
     * 
     * @param String $group;
     * @param Integer $id;
     * @return
     */
    private function getActiveAttributesByGroup(string $group, int $id)
    {
        return TemplateAttributesModel::where('active', 1)
                    ->where('group', $group)
                    ->where('template_id', $id)
                    ->orderBy('order')
                    ->get();
    }


    /**
     * Functie 
     * 
     * @param String $folder;
     * @return String;
     */
    private function getAllBladeFiles(string $folder)
    {
        return File::files(storage_path('../resources/views/templates/'.$folder.'/pages'));
    }


    /**
     * Functie voor het verwijderen van specifieke tabellen
     * 
     * @param Integer $id;
     * @return 
     */
    private function deleteTemplatesAttributesById($id)
    {
        return TemplateAttributesModel::where('template_id', $id)
                                ->delete();
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
     * @param Request $request;
     * @return Array
     */
    private function transformForm($request) : array
    {
        return [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'blade' => $request->input('blade'),
        ];
    }
}
