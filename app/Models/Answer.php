<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['body', 'user_id'];

    //relacion uno a muchos inversa
    public function question()
    {
        return $this->belongsTo(\App\Models\Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
