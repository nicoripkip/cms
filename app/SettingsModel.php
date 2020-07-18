<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingsModel extends Model
{
    /**
     * @var String $table;
     */
    protected $table = "settings";

    
    /**
     * @var Array $fillable;
     */
    protected $fillable = [
        'name',
        'value',
    ];
}
