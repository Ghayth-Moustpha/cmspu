<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Models\User;
use App\Http\Requests\CreateProjectRequest;

use Illuminate\Http\Request;
use App\Models\Project;
///C R U D 

class ProjectsController extends Controller
{

    //SHOW all project 

  

    public function index(Request $request)
    {
        // Retrieve the token from the bearer token in the request headers
        $token = $request->bearerToken();
        
        if ($token) {
            // Attempt authentication using Sanctum
            $user = Auth::guard('sanctum')->user();
    
            if ($user) {
                // User found. You can access the user's information.
                return response()->json(['projects' => $user->projects], 200);
            }
        }
    
        // Token not found or authentication failed.
        return response()->json([], 401);
    
    }
    public function show($id) 
    {   
      $project = Project::find($id) ; 
      return json_encode(["project" => $project ]) ;  
    }
    

    public function store(CreateProjectRequest $req)
    {
    
        $project = Project::create($req->validated());
    
        $user = $req->user();
        $user->projects()->attach($project);
 
        return response()->json(['message' => 'Project created successfully', 'project' => $project]);
    }
    public function update(Request $req , $id ) {
        $project = Project::find($id) ;

        $project->update($req->all()) ; 
        $project->save() ;
        return $project;
    }

    public function destroy($id)
    {
        $project = Project::find($id);
    
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }
    
        $project->delete();
    
        return response()->json(['message' => 'Project deleted successfully']);
    }

}
