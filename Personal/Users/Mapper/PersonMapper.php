<?php

/**
 * Responsible by mapping data of instance Person to Array, Csv, Json and others
 * @author Luis Alberto Batista Pedroso
 */
abstract class PersonMapper
{
    public static function objectToArray(Person $person): array
    {
        return [
            "id" => $person->getId(),
            "firstname" => $person->getFirstname(),
            "lastname" => $person->getLastname(),
            "birthday" => $person->Birthday->format("d/m/Y"),
            "gender" => CategoryMapper::objectToArray($person->Gender)
        ];
    }

    public static function listObjectsToArray(array $listObjects): array
    {
        $listArrays = [];

        foreach ($listObjects as $object) {
            $listArrays[] = self::objectToArray($object);
        }

        return $listArrays;
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

    /**
     * @param mixed $Data Any data with information of User on request
     * @return User An instance of User
     */
    public static function postToObject($Data): User
    {
        $User = new User();
        $User->setFirstname($Data["firstname"]);
        $User->setLastname($Data["lastname"]);
        $User->setBirthday($Data["birthday"]);
        $User->Gender->setCode($Data["gender"]["id"]);
        return $User;
    }

    public static function objectToJson(Person $person): string
    {
        return json_encode(self::objectToArray($person), JSON_FORCE_OBJECT);
    }
}