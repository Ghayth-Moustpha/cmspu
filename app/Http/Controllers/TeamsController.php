<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;

class TeamsController extends Controller
{
    public function shownot($project , $role )
{
    $project = Project::findOrFail($project);
    $usersWithRole = User::where('role', $role)->get();
    $usersNotInProject = $usersWithRole->reject(function ($user) use ($project) {
        return $project->users->contains($user);
    });

    if ($usersNotInProject->isEmpty()) {
        return response()->json([], 402);

    }

    // Return the users using a JSON response
    return response()->json($usersNotInProject, 200);
}
    public function show($project, $role)
    {
        // Retrieve users for a specific project where each user has a role called $role
        $users = User::whereHas('projects', function ($query) use ($project, $role) {
            $query->where('project_id', $project)
                ->where('role', $role);
        })->get();

        if ($users->isEmpty()) {
            return response()->json([], 204);
        }

        // Return the users
        return response()->json($users, 200);
    }

    public function attach( $project, $user)
    {
        // Retrieve the user and project
        $user = User::findOrFail($user);
        $project = Project::findOrFail($project);

        // Attach the user to the project
        $user->projects()->attach($project);

        // Return a success response
        return response()->json(['message' => 'User attached to the project successfully'], 200);
    }

    public function detach(Request $request, $project, $user)
    {
        // Retrieve the user and project
        $user = User::findOrFail($user);
        $project = Project::findOrFail($project);

        // Detach the user from the project
        $user->projects()->detach($project);

        // Return a success response
        return response()->json(['message' => 'User detached from the project successfully'], 200);
    }
}