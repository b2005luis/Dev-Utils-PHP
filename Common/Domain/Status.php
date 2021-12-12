<?php

/**
 * Import files
 */
require_once __DIR__ . "/../../Messages/Domain/Message.php";

/**
 * Represents one instance of State of one obeject
 * @uses Message
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Status
{
    /**
     * @var Message A instance of Message
     */
    public $Message;

    /**
     * @var string A text with the code of state object
     */
    protected $code;

    /**
     * @var string A text with name for scope of the Status
     */
    private $scope;

    /**
     * Initialize an instance of Status
     */
    public function __construct()
    {
        $this->Message = new Message();
        $this->Message->setContext("Factory");
        $this->setCode("NA");
    }

    /**
     * Generate a log file in the pre-defined location
     * @return void
     */
    public function GenerateLogFile(): void
    {
        date_default_timezone_set("America/Sao_Paulo");
        $Date = new DateTime();

        $Destination = "./log-error.txt";
        $Message_Type = 3;

        $Message = join("   ", [
                $Date->format("d/m/Y H:i:s"),
                $this->getScope(),
                $this->getCode(),
                $this->Message->getContent()
            ]) . PHP_EOL;

        error_log($Message, $Message_Type, $Destination);
    }

    /**
     * @return string A text with name for scope of the Status
     */
    public function getScope(): string
    {
        return $this->scope;
    }

    /**
     * @param string $scope A text with name for scope of the Status
     * @return void
     */
    public function setScope(string $scope): void
    {
        $this->scope = $scope;
    }

    /**
     * @return string A text with the code of state object
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code A text with the code of state object
     * @return void
     */
    public function setCode(string $code): void
    {
        $this->code = $code;
        $this->Message->DefineMessage($this);
    }

    /**
     * Return a array with data of instance Status
     * @return array A array with data of instance Status
     */
    public function GetInstanceArray()
    {
        return [
            "scope" => $this->getScope(),
            "code" => $this->getCode(),
            "Message" => $this->Message->GetInstanceArray()
        ];
    }
}
