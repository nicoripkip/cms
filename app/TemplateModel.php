<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateModel extends Model
{
    /**
     * @var String $table;
     */
    protected $table = 'templates';

    /**
     * @var Array $fillable
     */
    protected $fillable = [
        'name',
        'description',
        'blade',
    ];
}
