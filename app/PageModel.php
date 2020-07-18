<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TemplateModel;

class PageModel extends Model
{
    /**
     * @var String $table;
     */
    protected $table = 'pages';


    /**
     * @var Array $fillable;
     */
    protected $fillable = [
        'name',
        'icon',
        'view',
        'template_id',
    ];

    
    /**
     * Functie voor een relatie met de templates
     * 
     * @return Illuminate\Database\Eloquent\Model hasMany;
     */
    public function Templates()
    {
        return $this->hasMany(TemplateModel::class, 'template_id', 'id');
    }
}
