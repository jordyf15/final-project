<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CardNumberFormat implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $arr = str_split($value);
        for($i = 0; $i<count($arr); $i++){
            if($i==4 || $i==9||$i==14){
                if($arr[$i] != ' ')return false;
            }else{
                if(!is_numeric($arr[$i]))return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Must be 0000 0000 0000 0000 format.';
    }
}
