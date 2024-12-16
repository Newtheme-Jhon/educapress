<?php

namespace App\Observers;

use App\Models\Requirement;

class RequiremetObserver
{
    
    public function creating(Requirement $requirement)
    {
        $requirement->order = Requirement::where('course_id', $requirement->course_id)->max('order') + 1;
    }
}
