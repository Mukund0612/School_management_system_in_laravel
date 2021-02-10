<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class students extends Model
{
    public $fillable = array('stu_name', 'fath_name', 'class', 'phone_no', 'email');
}
