<?php

namespace App\Helpers;

class Helper
{
    public static function sanitize($request, $rules){
        $input = $request->all();

        foreach($rules as $key => $rule){
            if(array_key_exists($key, $input)) {
                switch ($rule) {
                    case 'string':
                        $input[$key] = filter_var($input[$key], FILTER_SANITIZE_STRING);
                        break;
                    case 'int':
                        $input[$key] = filter_var($input[$key], FILTER_SANITIZE_NUMBER_INT);
                        break;
                }
            }
        }

        return $input;
    }
}