<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\AttributeModel;

class TemplateAttributesModel extends Model
{
    /**
     * @var String $table;
     */
    protected $table = 'template_attribute';


    /**
     * @var Array $fillable;
     */
    protected $fillable = [
        'template_id',
        'attribute_id',
        'group',
        'bootstrap',
        'order',
        'active',
    ];


    /**
     * functie voor het ophalen van de attributes 
     */
    public function Attributes()
    {
        return $this->hasOne(AttributeModel::class, 'id', 'attribute_id');
    }
}
