<?php

/**
 * Responsible by mapping the instance User to Array, Csv, Json and others
 * @uses User
 * @uses CategoryMapper
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
    public static function listToJson(array $listUsers): string
    {
        $listJsons = [];
        foreach ($listUsers as $user) {
            $listJsons[] = self::objectToArray($user);
        }

        return json_encode($listJsons);
    }

    /**
     * @param array $rowSet An array with data to convert to instance of User
     * @return User An instance of User
     */
    public static function rowSetToObject(array $rowSet): User
    {
        $user = new User();
        $user->setId($rowSet["Person_Id"]);
        $user->setFirstname($rowSet["Person_Firstname"]);
        $user->setLastname($rowSet["Person_Lastname"]);
        $user->setBirthday($rowSet["Person_Birthday"]);
        $user->Gender->setId($rowSet["Gender_Id"]);
        $user->Gender->setCode($rowSet["Gender_Code"]);
        $user->Gender->setDescription($rowSet["Gender_Description"]);

        return $user;
    }
}