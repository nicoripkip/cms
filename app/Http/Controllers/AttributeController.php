<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\AttributeModel;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use App\MessageModel;

class AttributeController extends Controller
{
    /**
     * @var Carbon $date
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
     * @return Illuminate\Http\Request view;
     */
    public function index()
    {
        $this->middleware('checkrole:24');

        $attributes = AttributeModel::get();

        return view('attributes.read', compact('attributes'));
    }


    /**
     * Functie voor het aanmaken van de attribute gegevens
     * 
     * @return Illuminate\Http\Request view;
     */
    public function create()
    {
        $this->middleware('checkrole:25');

        return view('attributes.create');
    }


    /**
     * Funcite voor het opslaan vande gegevens
     * 
     * @param Request $request
     * @return Illuminate\Http\Request redirect;
     */
    public function store(Request $request)
    {
        AttributeModel::create($this->transformForm($request));
        $this->createMessage(['Succes','Attribute succesvol aangemaakt','fas fa-check-circle',0,$this->_date->toDateString(),$this->_date->toTimeString(),]);
        return redirect('/admin/attribute')->with('status', 'Attribute succesvol aangemaakt');
    }


    /**
     * Functie voor het laden van de update gegevens
     * 
     * @param Object $id
     * @return Illuminate\Http\Request view;
     */
    public function update(AttributeModel $attribute)
    {
        $this->middleware('checkrole:26');

        return view('attributes.update', compact('attribute'));
    }


    /**
     * Functie voor het opslaan van de geupdatete gegevens
     * 
     * @param Request $request;
     * @param AttributeModel $attribute;
     * @return Illuminate\Http\Request redirect;
     */
    public function put(Request $request, AttributeModel $attribute)
    {
        $attribute->update($this->transformForm($request));
        $this->createMessage(['Succes','Attribute succesvol geüpdated','fas fa-check-circle',0,$this->_date->toDateString(),$this->_date->toTimeString(),]);
        return redirect('/admin/attribute')->with('status', 'Attribute succesvol geüpdated');
    }


    /**
     * Functie voor het verwijderen van de gegevens
     * 
     * @param AttributeModel $attribute;
     * @return Illuminate\Http\Request redirect;
     */
    public function delete(AttributeModel $attribute)
    {
        $this->middleware('checkrole:27');

        $attribute->delete();
        $this->createMessage(['Succes','Attribute succesvol verwijderd','fas fa-check-circle',0,$this->_date->toDateString(),$this->_date->toTimeString(),]);
        return redirect('/admin/attribute')->with('status', 'Attribute succesvol verwijderd');
    }

    
    /**
     * Functie voor het maken van values
     * 
     * @param Request $request;
     * @return String 
     */
    private function getValue(Request $request) : string
    {
        if (isset($request->value)) {
            $array = [];
            foreach ($request->value as $item) {
                array_push($array, $item);
            }

            return implode(';', $array);
        } else {
            return "";
        }
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
     * Return van de standaard array
     * 
     * @param Object $request;
     * @param Object $attribute;
     * @return array
     */
    private function transformForm($request) : array
    {
        return [
            'name' => $request->input('name'),
            'group' => $request->input('group'),
            'type' => $request->input('type'),
            'value' => $this->getValue($request),
            'required' => $request->input('required'),
            'used' => 0,
        ];
    }
}