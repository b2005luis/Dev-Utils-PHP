<?php

/**
 * Represents one general category in the system
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Category
{
    /**
     * @var int A number with the identifier to category
     */
    protected $id;

    /**
     * @var string A text with the code of category
     */
    protected $code;

    /**
     * @var string A text with the description of category
     */
    protected $description;

    /**
     * Initialize an instance of Category
     */
    public function __construct()
    {
        $this->setId(0);
        $this->setCode("");
        $this->setDescription("");
    }

    /**
     * Returns an instance a array with the data of instance Category
     * @return array A array with the data of instance Category
     */
    public function GetInstanceArray(): array
    {
        return [
            "id" => $this->getId(),
            "code" => $this->getCode(),
            "description" => $this->getDescription()
        ];
    }

    /**
     * @return int A number with the identifier to category
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id A number with the identifier to category
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string A text with the code of category
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code A text with the code of category
     * @return void
     */
    public function setCode(string $code): void
    {
        $this->code = strtoupper(trim($code));
    }

    /**
     * @return string A text with the description of category
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description A text with the description of category
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = ucwords(trim($description));
    }
}