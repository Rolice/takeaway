<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Smslog extends Model
{
    protected $fillable = ['to', 'from', 'body', 'status', 'sid'];

    public $to;

    public $from;

    public $body;

    public $status;

    public $sid = null;

}
