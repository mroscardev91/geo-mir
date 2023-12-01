<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visibility extends Model
{
    use HasFactory;

    public function visibilities()
    {
        return $this->hasMany(Visibility::class, 'visibility_id');
    }
}
