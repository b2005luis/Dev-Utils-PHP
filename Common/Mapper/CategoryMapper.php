<?php

/**
 * Responsible by mapping the instance Gender to Array, Csv, Json and others
 * @author Luis Alberto Batista Pedroso
 */
abstract class CategoryMapper
{
    /**
     * Mapper to convert an instance of Gender to Array
     * @param Category $gender An instance of Gender
     * @return array An array with data of instance Gender
     */
    public static function objectToArray(Category $gender): array
    {
        $toArray["id"] = $gender->getId();
        $toArray["code"] = $gender->getCode();
        $toArray["description"] = $gender->getDescription();

        return $toArray;
    }

    /**
     * Mapper to convert an instance of Gender to Csv
     * @param Category $gender An instance of Category that represents a gender
     * @return string A formatted text with a instance of Csv representation
     * @example abs;123,cde;456\n
     */
    public static function objectToCsv(Category $gender): string
    {
        return join(";", self::objectToArray($gender)) . PHP_EOL;
    }

    /**
     * Mapper to convert an instance of Gender to Json
     * @param Category $gender An instance of Category that represents a gender
     * @return string A formatted text with a instance of json representation
     * @example {"name": "John Smicer"}
     */
    public static function objectToJson(Category $gender): string
    {
        return json_encode(self::objectToArray($gender), JSON_FORCE_OBJECT);
    }
}