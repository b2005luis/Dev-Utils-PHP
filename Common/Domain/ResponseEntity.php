<?php

/**
 * @author Luis Alberto Batista Pedroso
 */
class ResponseEntity
{
    /**
     * @var array An instance of any object to response request
     */
    public static $Data;

    /**
     * @var array An instance of Status to response to request
     */
    public static $Status;

    /**
     * @param string $key A key name for the response header
     * @param string $value A key value for the response header
     */
    public static function responseHeader(string $key, string $value)
    {
        header(join(":", [$key, $value]));
    }

    /**
     * @param int $code A number as a status code of response
     */
    public static function statusCode(int $code)
    {
        http_response_code($code);
    }

    /**
     * @return string A string as a json object to response request
     */
    public static function body(): string
    {
        return json_encode([
            "data" => self::$Data,
            "status" => self::$Status
        ]);
    }
}