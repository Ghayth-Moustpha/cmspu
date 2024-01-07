<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NeedStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Add your authorization logic here
        return true; // Change this as per your requirements
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'projectID' => 'required|integer',
        ];
    }

    /**
     * Get the data for storing the Need.
     *
     * @return array
     */
    public function getNeedData(): array
    {
        return [
            'title' => $this->input('title'),
            'description' => $this->input('description'),
            'project_id' => $this->input('projectID'),
            'user_id' => $this->user->id,
            'need_status_id' => 1 ,
        ];
    }
   
    /**
     * Get the UID from the Bearer token.
     *
     * @return int|null
     */
   
}