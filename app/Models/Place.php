<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'file_id', 'author_id'];

    //relacio amb la taula users, utilizant author_idz
    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    //relacio amb la taula users, utilizant user_id
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }


    // Relació amb la taula files
    public function file()
    {
        return $this->belongsTo(File::class);
    }

    // Relació amb la taula reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Relació amb la taula favorites
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}