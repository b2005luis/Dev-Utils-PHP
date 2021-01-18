<?php

/**
 * Represents an instance of Person in the system
 * @requires DateTime
 * @requires Category
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Person {

    /**
     * @var int A number with identifier of Person
     */
    private $id;

    /**
     * @return int A number with identifier of Person
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id A number with identifier of Person
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @var string A text with the name to Person
     */
    private $name;

    /**
     * @return string A text with the name to Person
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name A text with the name to Person
     */
    public function setName($name) {
        $this->name = ucwords(trim($name));
    }

    /**
     * @var string A text with last name to Person
     */
    private $lastName;

    /**
     * @return string A text with last name to Person
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * @param string $lastName A text with last name to Person
     */
    public function setLastName($lastName) {
        $this->lastName = ucwords(trim($lastName));
    }

    /**
     * @var DateTime An instance of DateTime to birthday of Person
     */
    public $Birthday;

    /**
     * @param string $data An instance of DateTime to birthday of Person
     */
    public function setBirthday(string $data) {
        $data = str_repeat("/", "-", $data);
        $this->Birthday->setTimestamp(strtotime($data));
    }

    /**
     * @var Category An instance of Gender
     */
    public $Gender;

    /**
     * Inicializa uma instancia de Pessoa.
     */
    public function __construct() {
        $this->Birthday = new DateTime();
        $this->Gender = new Category();
    }

    /**
     * Generate and return a array with data of instance object
     * @return array A array with data of instance
     */
    public function GetInstanceArray(): array {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "lastName" => $this->getLastName(),
            "Birthday" => $this->Birthday->getTimestamp(),
            "Gender" => $this->Gender->GetInstanceArray()
        ];
    }

}
