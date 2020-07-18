<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    /**
     * @var String $table
     */
    protected $table = 'messages';


    /**
     * @var array $fillable
     */
    protected $fillable = [
        'name',
        'message',
        'image',
        'read',
        'date',
        'time',
    ];


    /**
     * @var Boolean $timestamps
     */
    public $timestamps = false;
}