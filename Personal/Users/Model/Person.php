<?php

/**
 * Represents an instance of Person in the system
 * @uses DateTime
 * @uses Category
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Person
{
    /**
     * @var int A number with identifier of Person
     */
    private $id;

    /**
     * @var string A text with the name to Person
     */
    private $firstname;

    /**
     * @var string A text with last name to Person
     */
    private $lastname;

    /**
     * @var string A text with the full name of Person
     */
    private $fullname;

    /**
     * @var DateTime An instance of DateTime to birthday of Person
     */
    public $Birthday;

    /**
     * @var Category An instance of Gender
     */
    public $Gender;

    /**
     * @return int A number with identifier of Person
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id A number with identifier of Person
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string A text with the firstname to Person
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname A text with the firstname to Person
     * @return void
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = ucwords(trim($firstname));
        $this->setFullname();
    }

    /**
     * @return string A text with last name to Person
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname A text with last name to Person
     * @return void
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = ucwords(trim($lastname));
        $this->setFullname();
    }

    /**
     * @return string A text with the fullname of Person
     */
    public function getFullname(): string
    {
        return $this->fullname;
    }

    /**
     * @return void
     */
    public function setFullname(): void
    {
        $this->fullname = join(" ", [$this->getFirstname(), $this->getLastname()]);
    }

    /**
     * @param string $data An instance of DateTime to birthday of Person
     * @return void
     */
    public function setBirthday(string $data): void
    {
        $data = str_repeat("/", "-", $data);
        $this->Birthday->setTimestamp(strtotime($data));
    }

    /**
     * Inicializa uma instancia de Pessoa.
     */
    public function __construct()
    {
        $this->Birthday = new DateTime();
        $this->Gender = new Category();
    }

    /**
     * Generate and return a array with data of instance object
     * @return array A array with data of instance
     */
    public function GetInstanceArray(): array
    {
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