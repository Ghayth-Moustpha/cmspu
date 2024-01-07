<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectRequest extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        'title' => 'required|string',
          'description' => 'required|string',
           'Deadline' => 'required|date' , 
           'Notes'=>'required|string',
           
        ];
    }
}
