<?php

namespace App\Models;

use App\Observers\GoalObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([GoalObserver::class])]
class Goal extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'course_id', 'order'];
}
