<?php

namespace App\Common\Helpers;

use App\Common\ValidatorService;

class Helper
{
    /**
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return array
     */
   public static function validate(array $data, array $rules, array $messages = [], array $customAttributes = []): array
    {
        return ValidatorService::getInstance()->validate($data, $rules, $messages, $customAttributes);
    }
}