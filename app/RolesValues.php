<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\RolesValues;

class RolesValues extends Model
{
    /**
     * @var String $table
     */
    protected $table = 'roles_values';


    /**
     * @var array $fillable
     */
    protected $fillable = [
        'name',
        'value',
        'role_id',
    ];
}
