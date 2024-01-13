<?php

namespace App\Http\Controllers;

use App\Models\Requirement;
use Illuminate\Http\Request;
use App\Http\Requests\RequirementRequest;


class RequirementController extends Controller
{
    public function index($project_id)
    {
        $requirements = Requirement::with('actor')->where('project_id', $project_id)->get();

        // Transform the actor object to actor name
        $requirements = $requirements->map(function ($requirement) {
            $requirement['actor'] = $requirement->actor->name;
            return $requirement;
        });
    
        return response()->json(["requirements" => $requirements], 200);
        return response()->json(["requirements" => $requirements],200);
    }
    public function view($id)
    {
        $requirement = Requirement::find($id);
    
        if ($requirement) {
            return response()->json(["requirement" => $requirement], 200);
        } else {
            return response()->json(["requirement" => new Requirement()], 200);
        }
    }
    public function store(RequirementRequest $request)
    {
        $requirement = new Requirement();
        $requirement->fill($request->validated());
        $requirement->save();
        return response()->json(["message"=> "Requirement Saved Successfully "], 200);
        
    }
    
    public function need_Requirement ($need) {
        $requirements = Requirement::with('actor')->where('need_id', $need)->get();

        $requirements = $requirements->map(function ($requirement) {
            $requirement['actor'] = $requirement->actor->name;
            return $requirement;
        });
        return response()->json(["requirement"=> $requirements  ], 200);

    }
  
    
    public function update(RequirementRequest $request, Requirement $requirement)
    {
        $requirement->fill($request->validated());
        $requirement->save();
    
         return response()->json( ["requirement" => $requirement], 200);
    }
    
    public function destroy(Requirement $requirement)
    {
        $requirement->delete();
    
        return response()->json(["message" => "Requirement Deleted Successfully "], 200);
    }
    
}
