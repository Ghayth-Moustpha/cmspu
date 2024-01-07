<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Http\Requests\ReportStoreRequest;

class ReportController extends Controller
{

    public function store(ReportStoreRequest $request)
    {
        // Retrieve the validated data from the request
        $validatedData = $request->validated();
    
        $report = new Report();
        $report->title = $validatedData['title'];
        $report->content = $validatedData['content'];
        $report->user_id= $request->user->id ;
        $report->save();
        $users = User::where('role', Role::USER)
        ->whereIn('role', $validatedData['roles'])
        ->whereHas('projects', function ($query) use ($validatedData) {
            $query->where('id', $validatedData['projectID']);
        })
        ->get();

    // Loop through each user and attach the report as a receiver
    foreach ($users as $user) {
        DB::transaction(function () use ($report, $user) {
            $user->reports()->attach($report);
        });
    }

    // Optionally, you can do something with the receivers or perform additional actions

    // Optionally, you can return a response indicating the success of the operation
    return response()->json(['message' => 'Report created successfully'], 201);

    // Optionally, you can do something with the receivers or perform additional actions

    // Optionally, you can return a response indicating the success of the operation
    return response()->json(['message' => 'Report created successfully'], 201);
    }
}
