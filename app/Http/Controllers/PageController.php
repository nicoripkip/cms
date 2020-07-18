<?php

namespace App\Http\Controllers;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Http\Request;
use Auth;
use Schema;
use DB;
use Carbon\Carbon;

use App\PageModel;
use App\TemplateModel;
use App\TemplateAttributesModel;
use App\MessageModel;


class PageController extends Controller
{
    /**
     * @var Carbon $_date
     */
    protected $_date;


    /**
     * @var 
     */
    protected $userPerimissions;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_date = Carbon::now();
    }


    /**
     * Functie voor het ophalen van de read blade
     * 
     * @return Illuminate\Http\Request view;
     */
    public function index()
    {
        $test = Auth::user()->id;

            $pages = PageModel::get();

            return view('pages.read', compact('pages'));
    }


    /**
     * Functie voor het ophalen van de create
     * 
     * @return Illuminate\Http\Request view;
     */
    public function create()
    {
        $templates = TemplateModel::get();

        return view('pages.create', compact('templates'));
    }


    /**
     * Functie voor het opslaan van de gegevens
     * 
     * @param Request $request;
     * @return Illuminate\Http\Request view;
     */
    public function store(Request $request)
    {
        PageModel::create($this->transformForm($request));
        $this->createMessage(['Succes', 'Pagina succesvol aangemaakt', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(), ]);
        return redirect('/admin/page')->with('status', 'pagina succesvol aangemaakt');
    }


    /**
     * Functie voor het ophalen van de update pagina
     * 
     * @param PageModel $page;
     * @return Illuminate\Http\Request view;
     */
    public function update(PageModel $page)
    {
        $templates = TemplateModel::get();

        return view('pages.update', compact('page', 'templates'));
    }


    /**
     * Functie voor het updaten van de gegevens
     * 
     * @param PageModel $page;
     * @param Request $request;
     * @return Illuminate\Http\Request redirect;
     */
    public function put(Request $request, PageModel $page)
    {
        $page->update($this->transformForm($request));
        $this->createMessage(['Succes', 'Pagina succesvol geüpdated', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(), ]);
        return redirect('/admin/page')->with('status', 'Pagina succesvol geupdated');
    }


    /**
     * Functie voor het verwijderen van de gegevens
     * 
     * @param PageModel $page;
     * @return Illuminate\Http\Request redirect;
     */
    public function delete(PageModel $page)
    {
        if (Schema::hasTable('page_'.$page->name)) {
            DB::statement("DROP TABLE page_{$page->name}");
        }
        
        $page->delete();
        $this->createMessage(['Succes', 'Pagina succesvol verwijderd', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(), ]);
        return redirect('/admin/page')->with('status', 'Pagina succesvol verwijderd');
    }


    /**
     * Functie om de builder te laden
     * 
     * @param PageModel @page;
     * @return 
     */
    public function builder(PageModel $page) 
    {
        if (Schema::hasTable('page_'.$page->name)) {
            $page_data = DB::table('page_'.$page->name)->get()->first();
        } else {
            $page_data = null;
        }
        
        $attributes_main = $this->getAttributesByGroup('temlate_main', $page);
        $attributes_header = $this->getAttributesByGroup('temlate_header', $page);
        $attributes_body = $this->getAttributesByGroup('temlate_body', $page);
        $attributes_footer = $this->getAttributesByGroup('temlate_footer', $page);

        return view('pages.builder', compact('page', 'page_data', 'attributes_main', 'attributes_header', 'attributes_body', 'attributes_footer'));
    }


    /**
     * Functie om de builder data op te slaan
     * 
     * @param Request $request;
     * @param PageModel $page;
     * @return 
     */
    public function save(Request $request, PageModel $page)
    {
        $countColumn = DB::select(DB::raw("SELECT count(*) FROM information_schema.columns WHERE table_name = 'page_{$page->name}'"));
        $countColumn = (array)get_object_vars($countColumn[0]);

        if (Schema::hasTable('page_'.$page->name) == false || Schema::hasTable('page_'.$page->name) == true && $countColumn['count(*)'] != count($request->page)+1) {
            if (Schema::hasTable('page_'.$page->name)) {
                DB::statement("DROP TABLE page_{$page->name}");
            }
            
            $this->createDbScheme($request, $page->name);
        }
        foreach ($request->page as $key => $value) {
            $this->updatePageDataTable($page->name, [$key => $this->checkImage($value)]);
        }

        $this->createMessage(['Succes', 'Pagina succesvol gevult', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(), ]);
        return redirect('/admin/page')->with('status', 'Pagina succesvol gevult');
    }


    /**
     * functie voor het ophalen van de attributes
     * 
     * @param String $group;
     * @param PageModel $page;
     * @return
     */
    private function getAttributesByGroup(string $group, PageModel $page)
    {
        return TemplateAttributesModel::where('template_id', $page->template_id)
                ->where('group', $group)
                ->where('active', 1)
                ->orderBy('order')
                ->get();
    }


    /**
     * Functie voor het aanmaken van een pagina datatable
     * 
     * @param Request $request;
     * @param String $tablename;
     * @return 
     */
    private function createDbScheme(Request $request, string $tablename)
    {
        Schema::connection('mysql')->create('page_'.$tablename, function ($table) use ($request) {
            $table->bigIncrements('id');
            foreach ($request->page as $key => $value) {
                if (strpos(strtolower($key), 'textbox') !== false || strpos(strtolower($key), 'text box') !== false || strpos(strtolower($key), 'text_box') !== false) {
                    $table->text($key)->nullable();
                } else { 
                    $table->string($key)->nullable();
                }
            }
        });

        return DB::table('page_'.$tablename)->insert(['id' => 1]);
    }


    /**
     * Functie om een table te bewerken
     * 
     * @param 
     * @return
     */
    private function updatePageDataTable(string $tablename, array $tabledata = [])
    {
        return DB::table('page_'.$tablename)->where('id', 1)->update($tabledata);
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
    public function transformForm(Request $request) : array
    {
        return [
            'name' => $request->input('name'),
            'icon' => $request->input('icon'),
            'view' => $request->input('view'),
            'template_id' => $request->input('template'),
        ];
    }
}
