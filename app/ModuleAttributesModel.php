<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AttributeModel;

class ModuleAttributesModel extends Model
{
    /**
     * @var String $table;
     */
    protected $table = 'module_attributes';


    /**
     * @var Array $fillable;
     */
    protected $fillable = [
        'module_id',
        'attribute_id',
        'group',
        'bootstrap',
        'order',
        'active',
    ];


    /**
     * Relatie met de Attributen tabel
     */
    public function Attributes()
    {
        return $this->hasOne(AttributeModel::class, 'id', 'attribute_id');
    }
}
