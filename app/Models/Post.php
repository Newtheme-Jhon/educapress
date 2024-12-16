<?php

namespace App\Models;

use App\Enums\PostStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'create_at', 'update_at'];

    protected $casts = [
        'status'        => PostStatus::class,
        'published_at'  => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    //Relacion uno a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    //Es importatante que pase el nombre de la llave foranea, pues no sigue las convenciones de laravel 
    //si no paso el nombre no funciona la relación
    public function category(){
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    //Relacion muchos a muchos
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    //Relacion uno a muchos polimorfica
    public function questions(){
        return $this->morphMany(Question::class, 'questionable');
    }

}
