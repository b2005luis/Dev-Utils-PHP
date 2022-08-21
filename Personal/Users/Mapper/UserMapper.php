<?php

/**
 * Responsible by mapping the instance User to Array, Csv, Json and others
 * @uses User
 * @author Luis Alberto Batista Pedroso
 */
abstract class UserMapper
{
    /**
     * @param User $user An instance of User
     * @return array An arrau with data if instance of User
     */
    public static function objectToArray(User $user): array
    {
        $toArray["login"] = LoginMapper::objectToArray($user->Login);
        $toArray = array_merge($toArray, PersonMapper::objectToArray($user));

        return $toArray;
    }

    /**
     * @param User $user An instance of User
     * @return string A text with the instance Json representation of the User
     */
    public static function objectToJson(User $user): string
    {
        return json_encode(self::objectToArray($user), JSON_FORCE_OBJECT);
    }

    /**
     * @param array $listUsers An array with all datas of insatances of User in the list ou array
     * @return string A text with all datas of insatances of User in the list ou array
     */
    public static function listObjectsToJson(array $listUsers): string
    {
        $listJsons = [];
        foreach ($listUsers as $user) {
            $listJsons[] = self::objectToArray($user);
        }

        return json_encode($listJsons);
    }

    /**
     * @param array $listUsers An array with all datas of insatances of User in the list ou array
     * @return array An array with all datas of insatances of User in the list or array
     */
    public static function listObjectsToArray(array $listUsers): array
    {
        $listArray = [];
        foreach ($listUsers as $user) {
            $listArray[] = self::objectToArray($user);
        }

        return $listArray;
    }
}