<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeModel extends Model
{
    /**
     * @var String $table;
     */
    protected $table = 'attributes';


    /**
     * @var String $fillable;
     */
    protected $fillable = [
        'name',
        'group',
        'type',
        'value',
        'required',
        'used',
    ];
}
