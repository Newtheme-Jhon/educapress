<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherPayment extends Model
{

    /**
     * Para que la relacion inversa de teacher() funcione debemos de especificar  
     * el valor de la llave foranea en la relacion, es decir, aquin debemos añadir 'user_id'
     * Esto se hace porque no tenemos un modelo teacher, el modelo es user
     */
    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_id');
    }

}
