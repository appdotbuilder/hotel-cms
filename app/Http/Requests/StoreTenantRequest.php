<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTenantRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tenants,slug|regex:/^[a-z0-9-]+$/',
            'domain' => 'nullable|string|max:255|unique:tenants,domain',
            'database_name' => 'required|string|max:255|unique:tenants,database_name|regex:/^[a-z0-9_]+$/',
            'config' => 'nullable|array',
            'status' => 'required|in:active,inactive,suspended',
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Hotel name is required.',
            'slug.required' => 'URL slug is required.',
            'slug.unique' => 'This slug is already taken.',
            'slug.regex' => 'Slug can only contain lowercase letters, numbers, and hyphens.',
            'domain.unique' => 'This domain is already assigned to another tenant.',
            'database_name.required' => 'Database name is required.',
            'database_name.unique' => 'This database name is already taken.',
            'database_name.regex' => 'Database name can only contain lowercase letters, numbers, and underscores.',
        ];
    }
}