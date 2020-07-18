<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\MailModel;

class FormsModel extends Model
{
    /**
     * @var String $table
     */
    protected $table = 'forms';


    /**
     * @var Array $fillable 
     */
    protected $fillable = [
        'name',
        'description',
        'icon',
        'confirm_mail',
        'use_payment',
        'value',
    ];


    /**
     * HasOne relatie met Mails
     */
    public function Mails()
    {
        return $this->hasOne(MailModel::class, 'forms_id', 'id');
    }
}
