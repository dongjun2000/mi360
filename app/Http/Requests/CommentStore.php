<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStore extends FormRequest
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
            'article_id' => 'required|int',
            'comment_id' => 'sometimes|int',
            'reply_user_id' => 'sometimes|int',
            'content'    => 'required|max:255'
        ];
    }
}
