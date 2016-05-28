<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EditUser extends Request
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
        $input = $this->request->all();
        return [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $input['id'],
        ];
    }
}
