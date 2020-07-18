<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AttributeModel;

class ModuleModel extends Model
{
    /**
     * @var String $table;
     */
    protected $table = 'module';


    /**
     * @var Array $fillable;
     */
    protected $fillable = [
        'name',
        'icon',
        'slug',
    ];
}
