<?php

namespace App\Observers\Admin;

use App\Models\User;

class UserObserver
{
    public function creating(User $article){

        $article->sort = User::max('sort') + 1;
    }
    
}
