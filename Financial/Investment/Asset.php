<?php

/**
 * Represent an instance of Asset
 * @author Luis Alberto Batista Pedroso
 */
class Asset {

    /**
     * @var int A number with the identifier of Asset
     */
    private $id;

    /**
     * @return int A number with the identifier of Asset
     */
    function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id A number with the identifier of Asset
     * @return void
     */
    function setID(int $id): void {
        $this->id = $id;
    }

    /**
     * @var string A text with the default code ISIN to Asset
     */
    private $ISIN;

    /**
     * @return string A text with the default code ISIN to Asset
     */
    function getISIN(): string {
        return $this->ISIN;
    }

    /**
     * @param string $ISIN A text with the default code ISIN to Asset
     * @return void
     */
    function setISIN(string $ISIN): void {
        $this->ISIN = strtoupper(trim($ISIN));
    }

    /**
     *
     * @var string A text with the code of Asset
     */
    private $code;

    /**
     * @return string A text with the code of Asset
     */
    public function getCode(): string {
        return $this->code;
    }

    /**
     * @param string $code A text with the code of Asset
     * @return void
     */
    public function setCode(string $code): void {
        $this->code = strtoupper(trim($code));
    }

    /**
     * @var Company An instance of Company
     */
    private $Company;

    /**
     * @var Quotes An array with all instances of Quotes
     */
    public $ListOfQuotes;

    /**
     * @return Asset An instance of Asset
     */
    public function __construct() {
        $this->ListOfQuotes = [];
        $this->Company = new Company();
    }

    /**
     * Add a new quotes in the list of quotes
     * @param Quotes $Quotes An instance of Quotes
     */
    public function PushQuotes(Quotes $Quotes) {
        $this->ListOfQuotes[] = $Quotes;
    }

    /**
     * Return a array with the data of the instance Asset
     * @return array A array with the data of the instance Asset
     */
    public function GetInstanceArray(): array {
        // List of quotes
        $listOfQuotes = [];
        // Get all quotes as array data
        foreach ($this->ListOfQuotes as $Quotes) {
            $listOfQuotes[] = $Quotes->GetInstanceArray();
        }
        // Return data of instance as array
        return [
            "id" => $this->getId(),
            "ISIN" => $this->getISIN(),
            "code" => $this->getCode(),
            "Company" => $this->Company->GetInstanceArray(),
            "ListOfQuotes" => $listOfQuotes
        ];
    }

}
