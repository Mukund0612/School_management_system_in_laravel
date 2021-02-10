<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class branch extends Model
{
    public $fillable = array('branch_short_name', 'branch_full_name');
}
