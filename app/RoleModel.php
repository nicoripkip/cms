<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\RolesValues;
use App\RolesPermissions;

class RoleModel extends Model
{
    /**
     * @var Array $fillable
     */
    protected $fillable = [
        'title', 'description'
    ];


    /**
     * @var String $table;
     */
    protected $table = 'roles';


    /**
     * Relation: roles_values
     */
    public function Permissions()
    {
        return $this->hasMany(RolesValues::class, 'role_id', 'id');
    }


    /**
     * Relation: roles_permissions
     */
    public function RolesPermissions()
    {
        return $this->hasMany(RolesPermissions::class, 'role_id', 'id');
    }
}
