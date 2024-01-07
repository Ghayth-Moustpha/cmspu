<?php

namespace App\Policies;

use App\Models\RCR;
use App\Models\User;
use App\Models\Need;

use App\Models\Project;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Log;

class RCRPolicy
{
    /**
     * Determine whether the user can view any RCR in project.
     */
    public function viewAny(User $user , $projectId ): bool
    {
        return  $user->projects()->where('id', $projectId)->exists();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RCR $rcr)
    {
        // Check if the user is the creator of the RCR
        if ($rcr->user_id === $user->id) {
            return true;
        }
        // get the projects for the user  
        $project = Project::whereHas('users', function ($query) use ($user) {
                $query->where('users.id', $user->id);
            })
            ->whereHas('needs', function ($query) use ($rcr) { /// get the need for the project that in rcr 
                $query->where('needs.id', $rcr->need_id);
            })
            ->exists();
    
        return $project;
    }

    /**
     * Determine whether the user can create models.
     */
    public function store (User $user , Need $need ): bool
    {
      

        return true ; 
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RCR $rCR): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RCR $rCR): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RCR $rCR): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RCR $rCR): bool
    {
        //
    }
}
