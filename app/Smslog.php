<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Smslog extends Model
{
    protected $fillable = ['to', 'from', 'body', 'status'];

    public $to;

    public $from;

    public $body;

    public $status;

}
