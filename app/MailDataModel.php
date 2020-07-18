<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\MailModel;

class MailDataModel extends Model
{
    /**
     * @var String $table
     */
    protected $table = 'mails_data';


    /**
     * @var array $fillable
     */
    protected $fillable = [
        'subject',
        'to_email',
        'to_name',
        'body',
        'attachment',
        'from_name',
        'from_email',
        'mails_id'
    ];


    /**
     * Relatie met mail
     */
    public function Mails()
    {
        return $this->belongsTo(MailModel::class, 'mails_id', 'id');
    }
}
