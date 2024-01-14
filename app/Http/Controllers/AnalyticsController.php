<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        $analytics = Analytics::all();
        return response()->json($analytics, 200);
    }

    public function show($id)
    {
        $analytics = Analytics::find($id);
        if (!$analytics) {
            return response()->json(['message' => 'Analytics not found'], 404);
        }
        return response()->json($analytics, 200);
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string',
            'abstract' => 'required|string',
            'requirement_id' => 'required|integer|exists:requirements,id',
            'file' => 'required|file'
        ]);

        // Store the file in the specified filepath
        $filePath = $request->file('file')->store('analytics_files');

        // Create a new analytics record
        $analytics = new Analytics([
            'title' => $request->input('title'),
            'abstract' => $request->input('abstract'),
            'filepath' => $filePath,
            'requirement_id' => $request->input('requirement_id')
        ]);
        $analytics->save();

        return response()->json(['message' => 'Analytics record created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        // Find the analytics record
        $analytics = Analytics::find($id);
        if (!$analytics) {
            return response()->json(['message' => 'Analytics not found'], 404);
        }

        // Validate the request data
        $request->validate([
            'title' => 'string|',
            'abstract' => 'string',
            'requirement_id' => 'integer|exists:requirements,id',
            'file' => 'file'
        ]);

        // Update the analytics record
        if ($request->has('title')) {
            $analytics->title = $request->input('title');
        }
        if ($request->has('abstract')) {
            $analytics->abstract = $request->input('abstract');
        }
        if ($request->has('requirement_id')) {
            $analytics->requirement_id = $request->input('requirement_id');
        }
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('analytics_files');
            $analytics->filepath = $filePath;
        }
        $analytics->save();

        return response()->json(['message' => 'Analytics record updated successfully'], 200);
    }

    public function destroy($id)
    {
        // Find the analytics record
        $analytics = Analytics::find($id);
        if (!$analytics) {
            return response()->json(['message' => 'Analytics not found'], 404);
        }

        // Delete the analytics record
        $analytics->delete();
        
        return response()->json(['message' => 'Analytics record deleted successfully'], 200);
    }
}
