<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChartsResult extends Model
{
    protected $fillable = ['type', 'title', 'labels', 'values'];
}
