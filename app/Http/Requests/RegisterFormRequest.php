<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            //
            'member_username'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'member_username.required'=>'กรุณาระบุชื่อ Username'
        ];
    }
}
