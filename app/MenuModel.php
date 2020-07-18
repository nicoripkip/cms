<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PageModel;

class MenuModel extends Model
{
    /**
     * @var String $table;
     */
    protected $table = 'menu';


    /**
     * @var Array $fillable;
     */
    protected $fillable = [
        'name',
        'slug',
        'page_id',
        'sub_menu',
        'order',
        'active',
    ];

    
    /**
     * @return 
     */
    public function Pages()
    {
        return $this->hasOne(PageModel::class, 'menu', 'pages');
    }
}
