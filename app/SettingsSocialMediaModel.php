<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingsSocialMediaModel extends Model
{
    /**
     * @var String $table;
     */
    protected $table = 'settings_socialmedia';


    /**
     * @var Array $fillable;
     */
    protected $fillable = [
        'name',
        'value',
    ];
}
