<?php

/**
 * Import files
 */
require_once __DIR__ . "/../Model/Status.php";

/**
 * Implements an abstraction for treatment of web requests
 * @uses Status
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
abstract class AbstractWebRequest
{
    /**
     * @var string A coded text with a token code to indentify a recepted request to feature
     */
    protected $Token;

    /**
     * @var Status An instance of Status
     */
    public $Status;

    /**
     * @return AbstractWebRequest An instance of AbstractWebRequest
     */
    public function __construct()
    {
        $this->Status = new Status();
        $this->Status->Message->setContext("Factory");
    }

    /**
     * Forward for toggle suitable feature passed in the request type
     * @return void
     */
    protected abstract function DoGet(): void;

    /**
     * Forward for toggle suitable feature passed in the request type
     * @return void
     */
    protected abstract function DoPost(): void;

    /**
     * Validate the Token and execute the suitable function
     * @return void
     */
    public function ValidateRequest(): void
    {
        if (isset($_GET["Token"])) {
            $this->Token = $_GET["Token"];
            $this->DoGet();
        } else if (isset($_POST["Token"])) {
            $this->Token = $_POST["Token"];
            $this->DoPost();
        } else {
            $this->InvadRequest();
        }
    }

    /**
     * Response with a message of the invalid request
     * @return void
     */
    public function InvadRequest(): void
    {
        $this->Status->setCode("NA");
        $this->Status->Message->DefaultMessage($this->Status);
        $this->ResponseJSON($this->Status->Message->getContent(), $this->Status);
    }

    /**
     * @param array $data A array with the data of response of the request
     * @param Status $Status An instance od Status
     * @return void
     */
    public function ResponseJSON($data, Status $Status): void
    {
        print json_encode([
            "Data" => $data,
            "Status" => $Status->GetInstanceArray()
        ]);
    }
}
