<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_id',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //establecer la relacion de muchos a muchos
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_subcategory', 'subcategory_id', 'course_id');

    }

}
