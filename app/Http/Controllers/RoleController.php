<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

use App\RoleModel;
use App\MessageModel; 
use App\RolesValues;


class RoleController extends Controller
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
     * @return Illuminate\Http\Request view;
     */
    public function index()
    {
        $roles = RoleModel::get();

        return view('roles.read', compact('roles'));
    }


    /**
     * Functie voor het ophalen van de aanmaakpagina
     * 
     * @return Illuminate\Http\Request view;
     */
    public function create()
    {
        $permissions = RolesValues::get();

        return view('roles.create', compact('permissions'));
    }


    /**
     * Functie voor het opslaan van de create data
     * 
     * @param Request $request;
     * @return Illuminate\Http\Request redirect;
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|unique:roles'
        ]);
        $rol = $request->input('title');
        RoleModel::create(['title' => $rol]);
        $role = RoleModel::where('title', $rol)->get()->first();

        foreach ($request->role as $key => $value) {
            $permission = RolesValues::where('name', $key)->get()->first();
            DB::table('roles_permissions')->insert(['role_id' => $role->id, 'permission_id' => $permission->id, 'value' => $value]);
        }

        return redirect('/admin/role')->with('status', 'Rechten succesvol aangemaakt');
    }


    /**
     * Functie voor het ophalen van de updatepagina
     * 
     * @param Number $id
     * @return Illuminate\Http\Request view;
     */
    public function update(RoleModel $role)
    {
        $permissions = RolesValues::get();
        $koppeling = DB::table('roles_permissions')->where('role_id', $role->id)->get();

        return view('roles.update', compact('role', 'permissions', 'koppeling'));
    }


    /**
     * Functie voor het opslaan van de update data
     * 
     * @param RoleModel $role;
     * @param Request $request;
     * @return Illuminate\Http\Request redirect;
     */
    public function put(Request $request, RoleModel $role)
    {
        $request->validate([
            'title' => 'string|unique:roles'
        ]);
        $rol = $request->input('title');
        $role->update(['title' => $rol]);

        DB::table('roles_permissions')->where('role_id', $role->id)->delete();

        foreach ($request->role as $key => $value) {
            
            $permission = RolesValues::where('name', $key)->get()->first();
            DB::table('roles_permissions')->insert(['role_id' => $role->id, 'permission_id' => $permission->id, 'value' => $value]);
        }

        return redirect('/admin/role')->with('status', 'Rechten succesvol geüpdated');
    }


    /**
     * Functie voor het verwijderen van de role
     * 
     * @param RoleModel $role;
     * @return Illuminate\Http\Request redirect;
     */
    public function delete(RoleModel $role)
    {
        DB::table('roles_permissions')->where('role_id', $role->id)->delete();
        $role->delete();

        return redirect('/admin/role')->with('status', 'Rechten succesvol verwijderd');
    }


    /**
     * Array met alle DB gegevens
     * 
     * @param Request $request;
     * @param Mixed $key;
     * @param Integer $value;
     * @return Array;
     */
    private function transformForm($request, $key, $value)
    {
        return [
            'name' => $key,
            'value' => $value,
            'role_id' => $request->input('role_select'),
        ];
    }
}
