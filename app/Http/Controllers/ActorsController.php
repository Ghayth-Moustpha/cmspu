<?php

namespace App\Http\Controllers;
use App\Http\Requests\ActorStoreRequest;

use App\Http\Requests\ActorUpdateRequest;

use Illuminate\Http\Request;
use App\Models\Actor;
use App\Models\Project;

class ActorsController extends Controller
{

    public function index (Request $req , $id ) {

        $actors = Actor::where('project_id', $id)->get();

        return response()->json(["actors"=> $actors]  , 200 ) ; 
    }

    public function show (Request $req , $id ) {
        $actor = Actor::find ($id) ; 
        return response()->json(["actor"=> $actor]  , 200 ) ; 
    }

    public function store(ActorStoreRequest $req)
    {
        $data = $req->validated();
        $actor = Actor::create($data);
        
        return response()->json(['actor' => $actor], 201);
    }

    public function update (ActorUpdateRequest $req , $id ) {
      
        $actor = Actor::find ($id) ; 
        if (!$actor) {
            return response()->json(['message' => 'Actor not found'], 404);
        }
        $actor->update($req->validated()) ; 

        return response()->json(['actor' => $actor  ] , 200) ; 
    }
    public function destroy($id)
    {
        $actor = Actor::find($id);
        if (!$actor) {
            return response()->json(['message' => 'Actor not found'], 404);
        }

        $actor->delete();
        return response()->json(['message' => 'Actor deleted']);
    }
}
