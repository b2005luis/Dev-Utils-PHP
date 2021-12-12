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
            "fullname" => $person->getFullname(),
            "birthday" => $person->Birthday->format("d/m/Y"),
            "gender" => CategoryMapper::objectToArray($person->Gender)
        ];
    }

    public static function ubjectToJson(Person $person): string
    {
        return json_encode(self::objectToArray($person), JSON_FORCE_OBJECT);
    }
}