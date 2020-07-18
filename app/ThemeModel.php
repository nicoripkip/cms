<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThemeModel extends Model
{
    /**
     * @var String $table;
     */
    protected $table = 'theme';


    /**
     * @var Array $fillable;
     */
    protected $fillable = [
        'name',
        'description',
        'author',
        'company',
        'lisence',
        'selected',
    ];
}
