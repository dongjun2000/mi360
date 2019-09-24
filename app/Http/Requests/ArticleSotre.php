<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleSotre extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'nullable|required|exists:categories,id',
            'title' => 'required|min:2|max:80',
            'content' => 'required|min:100',
            'type' => 'numeric|in:1,2,3'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => '请选择文章分类',
            'category_id.exists' => '请选择正确的文章分类',
        ];
    }
}
