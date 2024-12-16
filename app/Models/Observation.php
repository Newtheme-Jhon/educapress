<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'course_id'];

    //relacion uno a uno inversa con el modelo course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}
