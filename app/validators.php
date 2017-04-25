<?php

Validator::extend('before_or_equal', function($attribute, $value, $parameters, $validator) {
    return strtotime($validator->getData()[$parameters[0]]) >= strtotime($value);
});

Validator::extend('olderThan', function($attribute, $value, $parameters)
{
    $minAge = ( ! empty($parameters)) ? (int) $parameters[0] : 13;
    return (new DateTime)->diff(new DateTime($value))->y >= $minAge;

});