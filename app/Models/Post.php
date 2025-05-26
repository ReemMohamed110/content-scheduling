<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    protected $fillable = ['title', 'content', 'image_url', 'scheduled_time', 'status', 'user_id'];
    public function platforms()
    {
        return $this->belongsToMany(Platform::class,'platform_post');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
