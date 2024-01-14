<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function download($filePath)
    {
        $path = storage_path($filePath);

        if (file_exists($path)) {
            return response()->download($path);
        } else {
           return "no fin";
        }
    }
}
