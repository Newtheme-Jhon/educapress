<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    //relacion uno a muchos inversa con users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
