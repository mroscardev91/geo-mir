<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'place_id', 'comment', 'rating'];

    // Relació amb la taula users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relació amb la taula places
    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
