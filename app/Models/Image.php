<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    protected $fillable = ['path', 'delete_at'];
    protected $dates = ['delete_at'];
}
