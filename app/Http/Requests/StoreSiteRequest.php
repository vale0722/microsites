<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSiteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required',
            'slug' => 'required|max:50|unique:sites',
            'name' => 'required|max:100',
            'document_type' => 'required',
            'document' => 'required|max:20',
        ];
    }
}
