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
        return [
            'name'=>'required|string',
            'price'=>'required|numeric',
            'rate'=>'required|decimal:1',
            'published'=>'boolean',
            'category_id'=>'required|integer|exists:categories,id',
            'image' =>'nullable|mimes:png,jpg,jpeg',
        ];
    }
}
