<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\MailDataModel;
use App\FormsModel;

class MailModel extends Model
{
    /**
     * @var String $table
     */
    protected $table = 'mails';


    /**
     * @var Array $fillable
     */
    protected $fillable = [
        'name',
        'description',
        'type_id',
        'forms_id',
        'weekly_send',
    ];


    /**
     * HasOne relatie met mails_data
     */
    public function MailData()
    {
        return $this->hasOne(MailDataModel::class, 'mails_id', 'id');
    }


    /**
     * BelongsTo relatie met Forms
     */
    public function Forms()
    {
        return $this->belongsTo(FormsModel::class, 'forms_id', 'id');
    }
}
