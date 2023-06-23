<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;
    protected $table = 'likes';

    public $primary = null;

    protected $fillable = [
        'user_id',
        'snippet_id'
    ];

    public function snippet(){
        return $this->belongsTo(Snippet::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}