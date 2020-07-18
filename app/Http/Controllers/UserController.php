<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\User;
use App\MessageModel;


class UserController extends Controller
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
     * Laat de read pagina zien
     * 
     * @return Illuminate\Http\Request view;
     */
    public function index()
    {
        $users = User::get();

        return view('users.read', compact('users'));
    }


    /**
     * Functie voor het aanmaken van de gebruiker
     * 
     * @return Illuminate\Http\Request view;
     */
    public function create()
    {
        $users = User::get();

        return view('users.create', compact('users'));
    }


    /**
     * Functie voor het opslaan van de create
     * 
     * @param Illuminate\Http\Request $request;
     * @return Illuminate\Http\Request redirect;
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'password_sec' => 'required|min:8|same:password'
        ]);

        $user = User::create($this->transformForm($request, null));
        $this->createMessage(['Succes', 'Gebruiker succesvol toegevoegd', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(),]);
        return redirect('/admin/user')->with('status', 'Gebruiker succesvol toegevoegd!');
    }


    /**
     * Functie voor het updaten van de gebruiker
     * 
     * @param Number $id
     * @return Illuminate\Http\Request view;
     */
    public function update($id)
    {
        $users = User::get();
        $user = User::where('id', $id)->get();

        return view('users.update', compact('users', 'user'));
    }


    /**
     * Functie voor het opslaan van de gegevens
     * 
     * @param Request $request
     * @param User $user
     * @return Illuminate\Http\Request view;
     */
    public function put(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'nullable|min:8',
            'password_sec' => 'nullable|min:8|same:password',
        ]);

        $user->update($this->transformForm($request, $user));
        $this->createMessage(['Succes', 'Gebruiker succesvol geüpdated', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(),]);
        return redirect('/admin/user')->with('status', 'Gebruiker succesvol geüpdated!');
    }


    /**
     * Functie voor het verwijderen van de gebruiker
     * 
     * @param User $user;
     * @return Illuminate\Http\Request view;
     */
    public function delete(User $user)
    {
        $user->delete();
        $this->createMessage(['Succes', 'Gebruiker succesvol verwijderd', 'fas fa-check-circle', 0, $this->_date->toDateString(), $this->_date->toTimeString(),]);
        return redirect('/admin/user')->with('status', 'Gebruiker succesvol verwijderd!');
    }


    /**
     * Functie voor het verwerken van een afbeelding
     *
     * @param Request $request
     * @param User $user
     * @return string
     *
    */
    private function checkImage($request, $user)
    {
        if (gettype($user) == "object") {
            Storage::delete($user->image);
        }

        if (is_null($request->file('image'))) {
            return null;
        }

        return $request->file('image')->store('media');
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
     * Standaard array voor de form
     * 
     * @param Request $request;
     * @param User $user;
     * @return Array;
     */
    private function transformForm($request, $user)
    {
        return [
            'name' => $request->input('username'),
            'email' => $request->input('email'),
            'role_id' => $request->input('role'),
            'password' => Hash::make($request->input('password')),
            'image' => $this->checkImage($request, $user),
        ];
    }
}
