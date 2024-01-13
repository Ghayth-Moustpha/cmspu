<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\User ;

use App\Http\Requests\ReportStoreRequest;

class ReportController extends Controller
{
    public function index(Request $req) { 
        $user = $req->user() ;

       return  response()->json(['reports' => $user->reports  ], 200);

    }

    public function show(Request $req , $id ) {
        $report = Report::find($id) ; 
        return  response()->json(['report' => $report  ], 200);

    }
    public function store(ReportStoreRequest $request)
    {
        // Retrieve the validated data from the request
        $validatedData = $request->validated();
    
        $report = new Report();
        $report->title = $validatedData['title'];
        $report->content = $validatedData['content'];
        $report->user_id= $request->user->id ;
        $report->save();
        $users = User::whereIn('role', $validatedData['roles'])
        ->whereHas('projects', function ($query) use ($validatedData) {
            $query->where('projects.id', $validatedData['projectID']);
        })
        ->get();

    // Loop through each user and attach the report as a receiver
    foreach ($users as $user) {
            $user->reports()->attach($report);
      
    }


    // Optionally, you can return a response indicating the success of the operation
    return response()->json(['message' => 'Report created successfully'], 201);


    }
    
}
