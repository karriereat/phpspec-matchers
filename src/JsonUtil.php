<?php

namespace Karriere\PhpSpecMatchers;

class JsonUtil
{
    public static function isValidJson($jsonString)
    {
        json_decode($jsonString);

        return json_last_error() === JSON_ERROR_NONE;
    }
}
