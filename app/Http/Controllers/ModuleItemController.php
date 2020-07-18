<?php

namespace App\Http\Controllers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Http\Request;
use DB;
use Schema;
use Carbon\Carbon;

use App\AttributeModel;
use App\ModuleModel;
use App\ModuleAttributesModel;
use App\MessageModel;


class ModuleItemController extends Controller
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
     * Functie voor het ophalen van de read pagina
     * 
     * @return 
     */
    public function index($module)
    {
        $modules = ModuleModel::where('slug', $module)->first();
        $table_items = ModuleAttributesModel::where('module_id', $modules->id)
                            ->where('active', 1)
                            ->limit(4)
                            ->orderBy('order')
                            ->get();

        $moduleitem = [];
        if (Schema::hasTable('module_'.$modules->slug)) {
            $moduleitem = DB::table('module_'.$modules->slug)->get();
        }

        return view('moduleItem.read', compact('modules', 'table_items', 'moduleitem'));
    }


    /**
     * Functie voor het opslaan van de gegevens
     * 
     * @param 
     * @return
     */
    public function create($module)
    {
        $modules = ModuleModel::where('slug', $module)->first();

        $main = $this->getAttributesByGroup('module_main', $modules->id);
        $body = $this->getAttributesByGroup('module_body', $modules->id);

        return view('moduleItem.create', compact('modules', 'main', 'body'));
    }


    /**
     * Functie om de data op te slaan
     * 
     * @param Request $request;
     * @return 
     */
    public function store(Request $request, string $module)
    {
        $module = ModuleModel::where('slug', $module)->get()->first();

        $countColumn = DB::select(DB::raw("SELECT count(*) FROM information_schema.columns WHERE table_name = 'module_{$module->slug}'"));
        $countColumn = (array)get_object_vars($countColumn[0]);

        if (Schema::hasTable('module_'.$module->slug) == false || Schema::hasTable('module_'.$module->slug) == true && $countColumn['count(*)'] != count($request->page)+1) {
            if (Schema::hasTable('module_'.$module->slug)) {
                DB::statement("DROP TABLE module_{$module->slug}");
            } 

            $this->createDBSchema($request, $module->slug);
        } 

        $insert_array = [];
        foreach ($request->page as $key => $value) {
            $insert_array[$key] = $this->checkImage($value) ;
        }

        DB::table('module_'.$module->slug)->insert($insert_array);
        $this->createMessage(['Succes', 'Module item succesvol toegevoegd', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString()]);
        return redirect('/admin/ModuleItem/'.$module->slug)->with('Status', 'Module item succesvol toegevoegd');
    }


    /**
     * Functie voor het ophalen van de update pagina 
     * 
     * @param String $module;
     * @param Integer $module;
     * @return
     */
    public function update(string $module, int $item)
    {
        $page_data = DB::table('module_'.$module)->where('id', $item)->get()->first();
        $modules = ModuleModel::where('slug', $module)->get()->first();
        $main = $this->getAttributesByGroup('module_main', $page_data->id);
        $body = $this->getAttributesByGroup('module_body', $page_data->id);

        return view('moduleItem.update', compact('page_data', 'item', 'modules', 'main', 'body'));
    }


    /**
     * Functie voor het updaten van de gegevens
     * 
     * @param Request $request
     * @param String $module;
     * @param Integer $item;
     * @return
     */
    public function put(Request $request, string $module, int $item)
    {
        $module = ModuleModel::where('slug', $module)->get()->first();

        $countColumn = DB::select(DB::raw("SELECT count(*) FROM information_schema.columns WHERE table_name = 'module_{$module->slug}'"));
        $countColumn = (array)get_object_vars($countColumn[0]);

        if (Schema::hasTable('module_'.$module->slug) == false || Schema::hasTable('module_'.$module->slug) == true && $countColumn['count(*)'] != (count($request->page) + 1)) {
            if (Schema::hasTable('module_'.$module->slug)) {
                DB::statement("DROP TABLE module_{$module->slug}");
            } 
            
            $this->createDBSchema($request, $module->slug);
        } 

        $update_array = [];
        foreach ($request->page as $key => $value) {
            $update_array[$key] = $this->checkImage($value);
        }

        DB::table('module_'.$module->name)->where('id', $item)->update($update_array);
        $this->createMessage(['Succes', 'Module item succesvol geüpdated', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(), ]);
        return redirect('/admin/ModuleItem/'.$module->name)->with('status', 'Module item succesvol geüpdated');
    }


    /**
     * Functie voor het verwijderen van de gegevens
     * 
     * @param String $module;
     * @param Integer $item;
     * @return 
     */
    public function delete(string $module, int $item)
    {
        DB::table('module_'.$module)->where('id', $item)->delete();
        $this->createMessage(['Succes', 'Module item succesvol verwijderd', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(), ]);
        return redirect('/admin/ModuleItem/'.$module)->with('status', 'Module item succesvol verwijderd');
    }


    /**
     * Functie voor het aanmaken van een db table
     * 
     * @param Request $request;
     * @param String $tablename;
     * @return 
     */
    private function createDBSchema(Request $request, string $tablename)
    {
        return Schema::connection('mysql')->create('module_'.$tablename, function ($table) use ($request) {
            $table->bigIncrements('id');
            foreach ($request->page as $key => $value) {
                if (strpos(strtolower($key), 'textbox') !== false || strpos(strtolower($key), 'text box') !== false || strpos(strtolower($key), 'text_box') !== false) {
                    $table->text($key)->nullable();
                } else { 
                    $table->string($key)->nullable();
                }
            }
        });
    }


    /**
     * Functie voor het ophalen van attributen
     * 
     * @param String $group;
     * @param Integer $id; 
     * @return 
     */
    private function getAttributesByGroup(string $group, int $id)
    {
        return ModuleAttributesModel::where('group', $group)
                    ->where('active', 1)
                    ->where('module_id', $id)
                    ->orderBy('order')
                    ->get();
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
     * Functie om afbeeldingen op te slaan
     * 
     * @param Request $request;
     * @return 
     */
    private function checkImage($request)
    {
        if ($request != null) {
            if (gettype($request) == 'string') {
                return $request;
            }

            return $request->store('media');
        } 
    }
}
