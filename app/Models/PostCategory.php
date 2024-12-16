<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Relacion de uno a muchos
    public function posts(){
        return $this->hasMany(Post::class);
    }

}
