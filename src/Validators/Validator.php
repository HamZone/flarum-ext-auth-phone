<?php

namespace HamZone\AuthPhone\Validators;

use Flarum\Foundation\AbstractValidator;

class Validator extends AbstractValidator
{
    protected $rules = [
        'userId'  => ['required', 'integer'],
        'phone' => ['required', 'string'],
    ];
}