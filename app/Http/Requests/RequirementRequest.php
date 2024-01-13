<?php

namespace App\Http\Requests;



use Illuminate\Foundation\Http\FormRequest;

class RequirementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'Type' => 'required|string',
            'priority' => 'required|integer',
            'actor_id' => 'required|exists:actors,id',
            'project_id' => 'required|exists:projects,id',
            'need_id' => 'required|exists:needs,id' , 
            'status' => 'required|integer',
        ];
}
}
