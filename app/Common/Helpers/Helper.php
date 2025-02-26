<?php

namespace App\Common\Helpers;

use App\Common\ValidatorService;

class Helper
{
   public static function validate(array $data, array $rules, array $messages = [], array $customAttributes = [])
    {
        return ValidatorService::getInstance()->validate($data, $rules, $messages, $customAttributes);
    }
}