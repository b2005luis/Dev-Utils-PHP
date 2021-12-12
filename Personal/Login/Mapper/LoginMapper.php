<?php

/**
 * Responsible by mapping the data of instance Login to Array, Csv, Json and others
 * @uses Login
 * @author Luis Alberto Batista Pedroso
 */
class LoginMapper
{
    /**
     * @param Login $login An instance of Login
     * @return array An array with data of instance of Login
     */
    public static function objectToArray(Login $login): array
    {
        $toArray["username"] = $login->getPassword();
        $toArray["password"] = $login->getPassword();
        $toArray["blocked"] = $login->isBlocked();

        return $toArray;
    }

    /**
     * @param Login $login An instance of Login
     * @return string A text with data like the Json notation
     */
    public static function objectToJson(Login $login): string
    {
        return json_encode(self::objectToArray($login), JSON_FORCE_OBJECT);
    }
}