<?php

/**
 * Represents an instance of Product
 * @uses Category
 * @uses Packaging
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Product
{
    /**
     * @var int A number with the identifier of Product
     */
    private $id;

    /**
     * @return int A number with the identifier of Product
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id A number with the identifier of Product
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @var string A text with the base code of Product
     */
    private $baseCode;

    /**
     * @return string A text with the base code of Product
     */
    public function getBaseCode(): string
    {
        return $this->baseCode;
    }

    /**
     * @param string $baseCode A text with the base code of Product
     * @return void
     */
    public function setBaseCode(string $baseCode): void
    {
        $this->baseCode = strtoupper(trim($baseCode));
    }

    /**
     * @var string A text with the Product code
     */
    private $code;

    /**
     * @return string A text with the Product code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code A text with the Product code
     * @return void
     */
    public function setCode(string $code): void
    {
        $this->code = strtoupper(trim($code));
    }

    /**
     * @var string A text with the description Product
     */
    private $description;

    /**
     * @return string A text with the description Product
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description A text with the description Product
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = ucwords(trim($description));
    }

    /**
     * @var Packaging An instance of Packaging
     */
    public $Packaging;

    /**
     * @var Category An instance of Category
     */
    public $Type;

    /**
     * @return Product An isntance of Product
     */
    public function __construct()
    {
        $this->Packaging = new Packaging();
        $this->Type = new Category();
    }

    /**
     * Returns a array with the data of instance Product
     * @return array A array with the data of onstance Product
     */
    public function GetInstanceArray(): array
    {
        return [
            "id" => $this->getId(),
            "baseCode" => $this->getBaseCode(),
            "code" => $this->getCode(),
            "description" => $this->getDescription(),
            "Packaging" => $this->Packaging->GetInstanceArray(),
            "Type" => $this->Type->GetInstanceArray()
        ];
    }
}
