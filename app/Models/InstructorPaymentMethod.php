<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InstructorPaymentMethod extends Model
{
    protected $fillable = ['instructor_id', 'payment_method', 'email_payment'];
}
