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
            throw new \Exception($validator->errors()->first(), 422);
        }

        return $validator->validated();
    }

    public function validateEdit(array $data, array $rules, array $messages = [], array $customAttributes = [])
    {
        $editedRules = [];
        foreach ($data as $key => $values) {
            if(isset($rules[$key])) {
                $editedRules[$key] = $rules[$key];
            }
        }

        $validator = Validator::make($data, $editedRules, $messages, $customAttributes);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first(), 422);
        }

        return $validator->validated();
    }
}