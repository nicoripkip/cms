<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

use App\AttributeModel;
use App\ModuleModel;
use App\ModuleAttributesModel;
use App\MessageModel;

class ModuleController extends Controller
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
        $this->_carbon = Carbon::now();
    }


    /**
     * Functie om de read pagina op te halen 
     * 
     * @return
     */
    public function index()
    {
        $modules = ModuleModel::get();

        return view('modules.read', compact('modules'));
    }


    /**
     *  Functie vcor het ophalen van de create pagina
     * 
     * @return 
     */
    public function create()
    {
        return view('modules.create');
    } 


    /**
     * Functie voor het opslaan van de create data 
     * 
     * @param Request $request;
     * @return 
     */
    public function store(Request $request)
    {
        ModuleModel::create($this->transformForm($request));

        $this->createMessage(['Succes', 'Module succesvol aangemaakt', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(),]);
        return redirect('admin/module')->with('status', 'Module succesvol aangemaakt');
    }


    /**
     * Functie om de updatepagina op te halen
     * 
     * @param ModuleModel $module;
     * @return 
     */
    public function update(ModuleModel $module)
    {
        return view('modules.update', compact('module'));
    }


    /**
     * Functie om de module gegevens uo te daten
     * 
     * @param Request $request;
     * @param ModuleModel $module;
     * @return 
     */
    public function put(Request $request, ModuleModel $module)
    {
        $module->update($this->transformForm($request));
        $this->createMessage(['Succes', 'Module succesvol geüpdated', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(), ]);
        return redirect('/admin/module')->with('status', 'Module succesvol geupdated');
    }


    /**
     * Functie om de gegegevsn te verwijderen
     * 
     * @param ModuleModel $module;
     * @return 
     */
    public function delete(ModuleModel $module)
    {
        $module->delete();
        $this->createMessage(['Succes', 'Module succesvol verwijderd', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(), ]);
        return redirect('/admin/module')->with('status', 'Module succesvol verwijderd');
    }


    /**
     * Functie om de builder te starten
     * 
     * @param ModuleModel $module;
     * @return 
     */
    public function builder(ModuleModel $module)
    {
        $attributes_main = $this->getAttributesByGroup('main', $module->id);
        $attributes_body = $this->getAttributesByGroup('body', $module->id);

        $active_main = $this->getActiveAttributesByGroup('module_main', $module->id);
        $active_body = $this->getActiveAttributesByGroup('module_body', $module->id);

        return view('modules.builder', compact('module', 'attributes_main', 'attributes_body', 'active_main', 'active_body'));
    }


    /**
     * 
     */
    public function save(Request $request, ModuleModel $module)
    {
        $this->deleteModuleAttributesById($module->id);
        foreach($request->request as $key => $value) {
            if (!empty($value) && is_array($value)){
                foreach($value as $val) {
                    if (isset($val['attribute_id']) && isset($val['bootstrap']) && isset($val['order']) && isset($val['active'])) {
                        ModuleAttributesModel::create([
                            'module_id' => $module->id,
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

        $this->createMessage(['Succes', 'Module template succesvol aangemaakt', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(), ]);
        return redirect('/admin/module')->with('status', 'Module template succesvol aangemaakt');
    }


    /**
     * Functie voor het ophalen van een attributegroup
     * 
     * @param String $group;
     * @param Integer $id;
     * @return AttributeModel 
     */
    private function getAttributesByGroup(string $group, int $id)
    {
        $array = [];
        $value = ModuleAttributesModel::where('module_id', $id)->where('active', 1)->get();
        foreach ($value as $val) {
            $array[] = $val->Attributes->name;
        }

        return AttributeModel::where('group', $group)->whereNotIn('name', $array)->get();
    }


    /**
     * Functie voor het ophalen van active attributen
     * 
     * @param String $group;
     * @param Integer $id;
     * @return 
     */
    private function getActiveAttributesByGroup(string $group, int $id)
    {
        return ModuleAttributesModel::where('active', 1)
                    ->where('group', $group)
                    ->where('module_id', $id)
                    ->orderBy('order')
                    ->get(); 
    }


    /**
     * Funcite voor het verwijderen 
     * 
     * @param Integer $id;
     * @return 
     */
    private function deleteModuleAttributesById(int $id)
    {
        return ModuleAttributesModel::where('module_id', $id)->delete();
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
     * Functie
     * 
     * @param Request $request;
     * @return Array
     */
    private function transformForm(Request $request)
    {
        return [
            'name' => $request->input('name'),
            'icon' => $request->input('icon'),
            'slug' => $request->input('slug'),
        ];
    }
}
