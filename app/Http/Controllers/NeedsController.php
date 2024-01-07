<?php

namespace App\Http\Controllers;

use App\Models\Need;
use Illuminate\Http\Request;
use App\Http\Requests\NeedStoreRequest;
use App\Http\Resources\NeedResources;

use App\Http\Requests\NeedsRequest;

use App\Http\Controllers\Controller;

class NeedsController extends Controller
{

    public function index(NeedsRequest $req)
    {
        $project_id = $req->getProject();
        $status = $req->getStatus();
        
        $needsQuery = Need::where('project_id', $project_id);
    
        if ($status != 0) {
            $needsQuery->where('need_status_id', $status);
        }
        
        $perPage = 5; // Number of needs per page
        $needs = $needsQuery->paginate($perPage);
        
        return response()->json(["needs" => $needs->items(), "total_pages" => $needs->lastPage()]);
    }

    public function show($id)
    {
        $need = Need::find($id);
        if (!$need) {
            return response()->json(['message' => 'Need not found'], 404);
        }
        $status = $need->NeedStatus ; 
        return response()->json(['id' =>  $need->id , 'title' => $need->title , "description" =>$need->description , 
       "status" =>$status ], 200);
    }

    public function store(NeedStoreRequest $request)
    {
        $need = Need::create($request->getNeedData());
        if ($need) {
            return response()->json(['message' => 'Need added successfully'], 200);
        } else {
            return response()->json(['message' => 'Failed to add need'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $need = Need::find($id);
        if (!$need) {
            return response()->json(['message' => 'Need not found'], 404);
        }

        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'project_id' => 'required|exists:projects,id',
        ]);

        $need->update($request->all());
        return response()->json($need);
    }

    public function destroy($id)
    {
        $need = Need::find($id);
        if (!$need) {
            return response()->json(['message' => 'Need not found'], 404);
        }

        $need->delete();
        return response()->json(['message' => 'Need deleted']);
    }
}