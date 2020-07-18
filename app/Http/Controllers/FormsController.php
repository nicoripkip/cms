<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Google_Client;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Schema;
use Carbon\Carbon;

use App\FormsModel;
use App\Exports\FormsExport;
use App\Mail\ResponseContact;
use App\FormsAttributesModel;
use App\AttributeModel;
use App\MessageModel;


class FormsController extends Controller
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
     * Functie voor het ophalen van de readpagina
     * 
     * @return Illuminate\Http\Request view
     */
    public function index()
    {
        $this->middleware('checkrole:33');

        $forms = FormsModel::get();

        return view('forms.read', compact('forms'));
    }


    /**
     * Functie voor het ophalen van de create pagina
     * 
     * @return Illuminate\Http\Request view
     */
    public function create()
    {
        $this->middleware('checkrole:34');

        return view('forms.create');
    }


    /**
     * Functie voor het opslaan van de data in de database
     * 
     * @param Request $request
     * @return Illuminate\Http\Request redirect
     */
    public function store(Request $request)
    {
        $date = Carbon::now();

        FormsModel::create($this->transformForm($request));
        $this->createMessage(['Succes', 'Formulieren succesvol aangemaakt', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(),]);
        return redirect('/admin/forms')->with('status', 'Formulier succesvol aangemaakt');
    }


    /**
     * Functie voor het ophalen van de update pagina
     * 
     * @param FormsModel $forms 
     * @return Illuminate\Http\Request view
     */
    public function update(FormsModel $forms)
    {
        $this->middleware('checkrole:35');

        return view('forms.update', compact('forms'));
    }


    /**
     * Functie om de data te updaten
     * 
     * @param Request $request
     * @param FormsModel $forms
     * @return Illuminate\Http\Request redirect
     */
    public function put(Request $request, FormsModel $forms)
    {
        $forms->update($this->transformForm($request));

        $this->createMessage(['Succes', 'Formulieren succesvol geüpdated', 0, 'fas fa-check-circle', $this->_date->toDateString(), $this->_date->toTimeString(),]);
        return redirect('/admin/forms')->with('status', 'Formulieren succesvol geupdated');
    }


    /**
     * Functie om de data te verwijderen
     * 
     * @param FormsModel $forms
     * @return Illuminate\Http\Request redirect
     */
    public function delete(FormsModel $forms)
    {
        $this->middleware('checkrole:36');

        $forms->delete();
        $this->createMessage(['Succes', 'Formulieren succesvol verwijderd', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(),]);
        return redirect('/admin/forms')->with('status', 'Formulier succesvol verwijderd');
    }


    /**
     * Functie voor het ophalen van de builder
     * 
     * @param FormsModel $forms
     * @return Illuminate\Http\Request view
     */
    public function builder(FormsModel $forms)
    {
        $this->middleware('checkrole:37');

        $attributes_body = $this->getAttributesByGroup('body', $forms->id);
        $active_body = $this->getActiveAttributesByGroup('forms_body', $forms->id);

        return view('forms.builder', compact('forms', 'active_body', 'attributes_body'));
    }


    /**
     * Functie voor het opslaan van de builder
     * 
     * @param
     * @return
     */
    public function save(Request $request, FormsModel $forms)
    {
        $this->deleteFormsAttributesById($forms->id);
        foreach($request->request as $key => $value) {
            if (!empty($value) && is_array($value)){
                foreach($value as $val) {
                    if (isset($val['attribute_id']) && isset($val['bootstrap']) && isset($val['order']) && isset($val['active'])) {
                        FormsAttributesModel::create([
                            'form_id' => $forms->id,
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

        $this->createTable($forms);
        $this->createMessage(['Succes', 'U heeft de formulieren template succesvol aangemaakt', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(),]);
        return redirect('/admin/forms')->with('status', 'U heeft de formulieren template succesvol aangemaakt');
    }


    /**
     * Functie voor het ophalen van een attributegroup
     * 
     * @param String $group;
     * @param Integer $id;
     * @return
     */
    private function getAttributesByGroup(string $group, int $id)
    {
        $array = [];
        $value = FormsAttributesModel::where('form_id', $id)->where('active', 1)->get();
        foreach ($value as $val) {
            $array[] = $val->Attributes->name;
        }

        return AttributeModel::where('group', $group)->whereNotIn('name', $array)->get();
    }


    /**
     * Funcite voor het verwijderen 
     * 
     * @param Integer $id;
     * @return 
     */
    private function deleteFormsAttributesById(int $id)
    {
        return FormsAttributesModel::where('form_id', $id)->delete();
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
        return FormsAttributesModel::where('active', 1)
                    ->where('group', $group)
                    ->where('form_id', $id)
                    ->orderBy('order')
                    ->get(); 
    }


    /**
     * Functie voor het aanmaken van een db table
     * 
     * @param
     * @return
     */
    private function createTable(FormsModel $forms)
    {
        $countColumn = DB::select(DB::raw("SELECT count(*) FROM information_schema.columns WHERE table_name = 'forms_{$forms->name}'"));
        $countColumn = (array)get_object_vars($countColumn[0]);
        $tables = FormsAttributesModel::where('active', 1)->where('form_id', $forms->id)->get();

        if (Schema::hasTable('forms_'.$forms->name) && $countColumn != (count($tables) + 3)) {
            Schema::drop('forms_'.$forms->name);
        }

        Schema::create('forms_'.$forms->name, function (Blueprint $table) use ($tables) {
            $table->bigIncrements('id');
            foreach ($tables as $value) {
                $table->string($value->Attributes->name);
            }
            $table->timestamps();
        });
    }


    /**
     * Functie voor het bouwen van de value
     * 
     * @param Request $request
     * @return String implode
     */
    private function getValue(Request $request)
    {
        if ($request->input('confirm_email') != 0) {
            $email = [];
            foreach ($request->email as $key => $value) {
                $email[$key] = $value;
            }
            return implode(';', $email);
        } 
        if ($request->input('use_payment') != 0) {
            $payment = [];
            foreach ($request->payment() as $key => $value) {
                $payment[$key] = $value;
            }
            return implode(';', $payment);
        }

        return " ";
    }


    /**
     * Functie voor het exporteren van het excel bestand
     * 
     * @param 
     * @return 
     */
    public function export(FormsModel $forms)
    {
        $this->middleware('checkrole:38');

        return Excel::download(new FormsExport($forms->name, $forms->id), 'results_forms.xlsx'); 
    }


    /**
     * functie voor het aanmaken van een email
     * 
     * @return
     */
    public function sendMail()
    {
        if (Request::ajax()) {
            $array = (array)Request::except('_token');
            Mail::to($array['email'])->send(new ResponseContact());

            return response()->json(['msg' => 'Taak succesvol uitgevoerd'], 200);
        }

        return response()->json(['msg' => 'Het werkt niet'], 400);
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
     * @param Request $request
     * @return Array
     */
    private function transformForm(Request $request) : array
    {
        return [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'icon' => $request->input('icon'),
            'confirm_mail' => $request->input('confirm_email'),
            'use_payment' => $request->input('use_payment'),
            'value' => $this->getValue($request),
        ];
    }
}
