<?php

namespace App\Observers;

use App\Models\Goal;

class GoalObserver
{
    public function creating(Goal $goal)
    {
        $goal->order = Goal::where('course_id', $goal->course_id)->max('order') + 1;
    }
}
