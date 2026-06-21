<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        $rules = [
            'judul'          => 'required|string|max:255',
            'slug'           => ['nullable', 'string', Rule::unique('posts')->ignore($this->route('beritum'))],
            'category_id'    => 'required|exists:categories,id',
            'status'         => 'required|in:draft,published,archived',
            'published_at'   => 'nullable|date',
            'isi'            => 'required|string',
            'thumbnail'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        // If the route parameter 'beritum' is not present (e.g., store action), ignore the ID
        if (!$this->route('beritum')) {
            $rules['slug'] = ['nullable', 'string', 'unique:posts,slug'];
        }

        return $rules;
    }
}