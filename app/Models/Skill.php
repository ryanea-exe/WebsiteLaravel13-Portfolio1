<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $table = 'skiils';

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
