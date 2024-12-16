<?php

namespace App\Models;

use App\Observers\RequiremetObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([RequiremetObserver::class])]
class Requirement extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'course_id', 'order'];
}
