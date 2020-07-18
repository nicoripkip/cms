<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingsAlgemeenModel extends Model
{
    /**
     * @var String $table;
     */
    protected $table = 'settings_algemeen';

    protected $fillable = [
        'name',
        'value',
    ];
}
