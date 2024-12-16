<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{

    protected $fillable = [
        'body',
        'user_id'
    ];

    //relación uno a muchos
    public function answers()
    {
        return $this->hasMany(\App\Models\Answer::class);
    }

    //relación uno a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function questionable()
    {
        return $this->morphTo();
    }
}
