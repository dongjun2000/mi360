<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSettings extends FormRequest
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
            'name' => 'required',
            'gender' => 'required|in:0,1',
            ''
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '用户名不能为空',
            'gender.in' => '请选择正确的性别选项',
        ];
    }
}
