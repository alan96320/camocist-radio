<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            "title" => "required|min:3|max:255",
            "description" => "required|min:3|max:255",
            "content" => "required|min:3",
            "category_id" => "required",
            "date" => "required|date",
           /* "image" => [
                $this->request->get('_method') == 'PUT' ? 'nullable' : 'required',
                "image"
            ]*/
        ];
    }
}
