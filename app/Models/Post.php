<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'image',
        'author_id',
        'file_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
    public function file()
    {
        return $this->belongsTo(File::class, 'file_id');
    }

    public function liked()
    {
        return $this->belongsToMany(User::class, 'likes');
    }


}
