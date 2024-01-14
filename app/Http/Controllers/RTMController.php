<?php

namespace App\Http\Controllers;
use App\Models\Requirement;

use Illuminate\Http\Request;

class RTMController extends Controller
{
    public function index($project_id) {
        $requirements = Requirement::with('analytics', 'codes', 'designs', 'tests' , 'actor')
        ->where('project_id', $project_id)
        ->get();

    if ($requirements->isEmpty()) {
        return response()->json(['message' => 'No requirements found for the project'], 404);
    }

    return response()->json(['_RTM' => $requirements]);
    }
}
