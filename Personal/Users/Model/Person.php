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
    private $firstname;

    /**
     * @return string A text with the firstname to Person
     */
    public function getFirstname() {
        return $this->firstname;
    }

    /**
     * @param string $firstname A text with the firstname to Person
     */
    public function setName($firstname) {
        $this->firstname = ucwords(trim($firstname));
        $this->setFullname();
    }

    /**
     * @var string A text with last name to Person
     */
    private $lastname;

    /**
     * @return string A text with last name to Person
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * @param string $lastname A text with last name to Person
     */
    public function setLastname($lastname) {
        $this->lastname = ucwords(trim($lastname));
        $this->setFullname();
    }

    /**
     * @var string A text with the full name of Person
     */
    private $fullname;
    
    /**
     * @return string A text with the full name of Person
     */
    public function getFullname(): string {
        return $this->fullname;
    }

    /**
     * @return void
     */
    public function setFullname(): void {
        $this->fullname = join(" ", [$this->getFirstname(), $this->getLastname()]);
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
            "firstname" => $this->getFirstname(),
            "lastname" => $this->getLastname(),
            "fullname" => $this->getFullname(),
            "Birthday" => $this->Birthday->getTimestamp(),
            "Gender" => $this->Gender->GetInstanceArray()
        ];
    }

}
