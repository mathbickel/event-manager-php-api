<?php

namespace App\Common;

use Illuminate\Support\Facades\Validator;

class ValidatorService
{
    /**
     * @return ValidatorService
     */
    public static function getInstance(): self
    {
        return new ValidatorService();
    }

    /**
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return array
     * @throws ValidationException
     */
    public function validate(array $data, array $rules, array $messages = [], array $customAttributes = []): array
    {
        $validator = Validator::make($data, $rules, $messages, $customAttributes);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }

        return $validator->validated();
    }
}