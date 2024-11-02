<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = ['name', 'path', 'size', 'type','user_id','cookie_local_temp'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
