<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $k = count($this->segments());
        $endPoint = $this->segment($k);
        switch ($endPoint) {
            case 'create':
                return $this->createValidation();
            case 'update':
                return $this->updateValidation();
            case 'delete':
            case 'get':
                return $this->idValidation();
            case 'all':
                return $this->allValidation();

            default:
                return [];
        }
    }


    /**
     * A method that defines the validation rules for creating a new post.
     *
     * @return array The validation rules array for creating a new post.
     */
    private function createValidation()
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:150'],
            'content' => ['required', 'string', 'min:5'],
            'image' => ['nullable', 'image', 'mimes:jpeg,bmp,png,webp,svg,gif,tiff,jpg'],
        ];
    }
    
    /**
     * A method that defines the validation rules for updating a post.
     *
     * @return array The validation rules array for updating a post.
     */
    private function updateValidation()
    {
        return [
            'id' => ['required', 'exists:posts,id'],
            'title' => ['required', 'string', 'min:3', 'max:150'],
            'content' => ['required', 'string', 'min:5'],
            'image' => ['nullable', 'image', 'mimes:jpeg,bmp,png,webp,svg,gif,tiff,jpg'],
        ];
    }
    private function idValidation()
    {
        return [
            'id' => ['required', 'exists:posts,id'],
        ];
    }
    private function allValidation()
    {
        return [
            'is_paginate' => ['nullable', 'integer'],
        ];
    }
}

