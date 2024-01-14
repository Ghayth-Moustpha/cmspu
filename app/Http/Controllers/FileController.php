<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function download($folderpath,$filePath)
    {
        $path = public_path('storage/' . $folderpath . '/' . $filePath);

        if (file_exists($path)) {
            return response()->download($path);
        } else {
            return response()->json(['error' => 'File not found.' . $path ], 404);
        }
    }
}
