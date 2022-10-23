<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SortRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sort_field' => ['filled', Rule::in(array_values(Post::SORTABLE_FIELDS))]
        ];
    }
}
