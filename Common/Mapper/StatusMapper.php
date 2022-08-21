<?php

/**
 * @uses Status
 * @uses MessageMapper
 */
class StatusMapper
{
    public static function objectToArray(Status $status)
    {
        return [
            "scope" => $status->getScope(),
            "code" => $status->getCode(),
            "MESSAGE" => MessageMapper::objectToArray($status->Message)
        ];
    }

    public static function objectToJson(Status $status)
    {
        return json_encode(self::objectToArray($status), JSON_FORCE_OBJECT);
    }
}