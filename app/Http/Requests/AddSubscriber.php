<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AddSubscriber extends Request
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
            'sub_name' => 'required|max:255',
            'sub_email' => 'required|email|unique:subscribers,sub_email',
        ];
    }
}
