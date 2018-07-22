<?php

namespace App\Http\Requests;

use App\Helpers\Helper;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $url = $this->path();
        $segments = explode('/', $url);
        $id = end($segments);

        $sanitize_rules = [
            'login' => 'string',
            'password' => 'string',
        ];
        $rules = [
            'login' => 'string|min:3|max:12|unique:users,login,' . $id,
            'password' => 'string|min:6|max:20|confirmed'
        ];

        $this->merge(Helper::sanitize($this, $sanitize_rules));

        return $rules;
    }
}
