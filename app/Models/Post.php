<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = "post";
    protected $fillable = [
        'title',
        'description',
        'url_image'
    ];

    public function comment ()
    {
        return $this->hasMany(Comment::class);
    }
}
