<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
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
            'user_id' => [Rule::exists('users', 'id')],
            'title' => ['bail', 'required', 'string', 'min:3', 'max:100'],
            'author' => ['bail', 'required', 'string', 'min:3', 'max:50'],
            'isbn' => ['bail', 'required', 'string', 'min:13', 'max:13', Rule::unique('books')->ignore($this->id)],
            'plot' => ['bail'],
        ];
    }
}
