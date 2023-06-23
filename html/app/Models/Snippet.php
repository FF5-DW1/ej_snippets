<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'code'
    ];

    public function comentarios() {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'DESC');
    }

    public function all_comments() {
        return $this->hasMany(Comment::class)->withTrashed()->orderBy('created_at', 'DESC');
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

 
}
