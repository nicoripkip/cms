<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolesPermissions extends Model
{
    /**
     * @var String $table
     */
    protected $table = 'roles_permissions';


    /**
     * @var array $fillable
     */
    protected $fillable = [
        'role_id',
        'permission_id',
        'value',
    ];
}
