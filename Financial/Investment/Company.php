<?php

/**
 * Represents an instance of Company
 * @requires Category
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Company {

    /**
     * @var int A number with the identifier of Company
     */
    private $id;

    /**
     * @return int A number with the identifier of Company
     */
    function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id A number with the identifier of Company
     * @return void
     */
    function setID(int $id): void {
        $this->id = $id;
    }

    /**
     * @var string A text with the CNPJ of the Company
     */
    private $CNPJ;

    /**
     * @return string A text with the CNPJ of the Company
     */
    function getCNPJ(): string {
        return $this->CNPJ;
    }

    /**
     * @param string $CNPJ A text with the CNPJ of the Company
     * @return void
     */
    function setCNPJ(string $CNPJ): void {
        $this->CNPJ = $CNPJ;
    }

    /**
     * @var string A text with the name of the Company
     */
    private $name;

    /**
     * @return string A text with the name of the Company
     */
    function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name A text with the name of the Company
     * @return void
     */
    function setName(string $name): void {
        $this->name = ucwords(trim($name));
    }

    /**
     * @var string A text with the long name of the Company
     */
    private $longName;

    /**
     * @return string A text with the long name of the Company
     */
    function getLongName(): string {
        return $this->longName;
    }

    /**
     * @param string $longName A text with the long name of the Company
     * @return void
     */
    function setLongName(string $longName): void {
        $this->longName = ucwords(trim($longName));
    }

    /**
     * @var string A text with the code of the Company
     */
    private $code;

    /**
     * @return string A text with the code of the Company
     */
    function getCode(): string {
        return $this->code;
    }

    /**
     * @param string $code A text with the code of the Company
     * @return void
     */
    function setCode(string $code): void {
        $this->code = strtoupper(trim($code));
    }

    /**
     * @var Category An instance of Category that represenr a Listing Segment
     */
    public $ListingSegment;

    /**
     * Initialize an instance of Company
     */
    public function __construct() {
        $this->ListingSegment = new Category();
    }

    /**
     * Return a array with the data of instance Category
     * @return array A array with the data of instance Category
     */
    public function GetInstanceArray(): array {
        return [
            "id" => $this->getId(),
            "CNPJ" => $this->getCNPJ(),
            "name" => $this->getName(),
            "longName" => $this->getLongName(),
            "code" => $this->getCode(),
            "ListingSegment" => $this->ListingSegment->GetInstanceArray()
        ];
    }

}
