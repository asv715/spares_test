<?php

namespace App\Traits;

use App\Constants\Messages;
use App\Exceptions\OverallException;

trait FailedValidation
{
    /**
     * @throws OverallException
     */
    public function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $errors = $validator->errors();

        throw new OverallException($errors ? $errors->first() : Messages::DEFAULT_VALIDATION_ERROR_TEXT, 400);
    }
}
