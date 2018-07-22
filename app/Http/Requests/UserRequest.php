<?php

namespace App\Http\Requests;

use App\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $sanitize_rules = [
            'login' => 'string',
            'password' => 'string',
        ];
        $rules = [
            'login' => 'required|string|min:3|max:12|unique:users',
            'password' => 'required|string|min:6|max:20|confirmed'
        ];

        $this->merge(Helper::sanitize($this, $sanitize_rules));

        return $rules;
    }
}
