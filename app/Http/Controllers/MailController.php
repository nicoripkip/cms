<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use App\MailModel;
use App\FormsModel;
use App\MailDataModel;
use App\MessageModel;


class MailController extends Controller
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
        $mails = MailModel::get();

        return view('mails.read', compact('mails'));
    }


    /**
     * Functie voor het ophalen van de create pagina
     * 
     * @return Illuminate\Http\Request view
     */
    public function create()
    {
        $types = DB::table('mails_types')->get();
        $forms = FormsModel::get();

        return view('mails.create', compact('types', 'forms'));
    }


    /**
     * Functie voor het opslaan van de gegevens in de database
     * 
     * @param Request $request
     * @return Illuminate\Http\Request redirect
     */
    public function store(Request $request)
    {
        MailModel::create($this->transformForm($request));
        $this->createMessage(['Succes', 'U heeft succesvol een mail aangemaakt', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(), ]);
        return redirect('/admin/mails')->with('status', 'U hebt succesvol een mail aangemaakt');
    }


    /**
     * Functie voor het ophalen van de update pagina
     * 
     * @param MailModel $mail
     * @return Illuminate\Http\Request view
     */
    public function update(MailModel $mail)
    {
        $types = DB::table('mails_types')->get();
        $forms = FormsModel::get();

        return view('mails.update', compact('mail', 'types', 'forms'));
    }


    /**
     * Functie voor het updaten van de gegevens
     * 
     * @param Request $request
     * @param MailModel $mail
     * @return Illuminate\Http\Request redirect
     */
    public function put(Request $request, MailModel $mail)
    {
        $mail->update($this->transformForm($request));
        $this->createMessage(['Succes', 'U heeft de mails succesvol geüpdated', 'fas fa-check-cirkle', 0, $this->_date->toDateString(), $this->_date->toTimeString(), ]);
        return redirect('/admin/mails')->with('status', 'U heeft de mails succesvol geupdated');
    }


    /**
     * Functie om de gegevens te verwijderen
     * 
     * @param MailModel $mail
     * @return Illuminate\Http\Request redirect
     */
    public function delete(MailModel $mail)
    {
        if (count(MailDataModel::where('mails_id', $mail->id)->get()) > 0) {
            $data = MailDataModel::where('mails_id', $mail->id)->get();
            Storage::delete($data->attachment);
            $data->delete();
        }
        
        $mail->delete();
        $this->createMessage(['Succes', 'U heeft de mail succesvol verwijderd', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString()]);
        return redirect('/admin/mails')->with('status', 'U heeft de mail succesvol verwijderd');
    }


    /**
     * Functie voor het ophalen van de builder
     * 
     * @param MailModel $mail
     * @return Illuminate\Http\Request view
     */
    public function builder(MailModel $mail)
    {
        $data = MailDataModel::where('mails_id', $mail->id)->get()->first();

        return view('mails.builder', compact('mail', 'data'));
    }


    /**
     * Functie voor het opslaan van de builder
     * 
     * @param Request $request
     * @param MailModel $mail
     * @return Illuminate\Http\Request redirect
     */
    public function save(Request $request, MailModel $mail)
    {
        if (count(MailDataModel::where('mails_id', $mail->id)->get()) > 0) {
            $model = MailDataModel::where('mails_id', $mail->id)->get()->first();
            $model->update([
                'subject' => $request->input('subject'),
                'to_email' => $request->input('reciever_email'),
                'to_name' => $request->input('reciever_name'),
                'body' => $request->input('body'),
                'attachment' => $this->fileHandler($request, $model),
                'from_name' => $request->input('sender_name'),
                'from_email' => $request->input('sender_email'),
                'mails_id' => $request->input('mails_id'),
            ]);

            return redirect('/admin/mails')->with('status', 'Maildata succesvol geupdated');
        } else {
            MailDataModel::create([
                'subject' => $request->input('subject'),
                'to_email' => $request->input('reciever_email'),
                'to_name' => $request->input('reciever_name'),
                'body' => $request->input('body'),
                'attachment' => $this->fileHandler($request, null),
                'from_name' => $request->input('sender_name'),
                'from_email' => $request->input('sender_email'),
                'mails_id' => $request->input('mails_id'),
            ]);

            $this->createMessage(['Succes', 'Maildata succesvol aangemaakt', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(),]);
            return redirect('/admin/mails')->with('status', 'Maildata succesvol aangemaakt');
        }
    }


    /**
     * Functie voor een file handler
     * 
     * @param Request $request
     * @param MailDataModel $data
     * @return
     */
    private function fileHandler(Request $request, $data)
    {
        if (gettype($data) == "object") {
            Storage::delete($data->attachment ?? '');
        }

        if (is_null($request->file('attachment'))) {
            return null;
        }

        return $request->file('attachment')->store('media');
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
     * @return array
     */
    private function transformForm(Request $request)
    {
        return [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'type_id' => $request->input('type_id'),
            'forms_id' => $request->input('forms_id'),
        ];
    }
}