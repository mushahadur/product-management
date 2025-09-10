<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'categories' => 'required|array|min:1',
            'categories.*' => 'exists:categories,id',
            ];
            if ($this->getMethod() == 'POST') {
            $rules += ['image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048'];
            }
            else{
            
            $rules += ['image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'];
            }
            return $rules;
    }
}
