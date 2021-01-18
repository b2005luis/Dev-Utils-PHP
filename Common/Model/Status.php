<?php

/**
 * Represents one instance of State of one obeject
 * @requires Message
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Status {

    /**
     * @var string A text with name to Context of object and your state
     */
    protected $context;

    /**
     * @return string A text with name to Context of object and your state
     */
    public function getContext(): string {
        return $this->context;
    }

    /**
     * @param string $context A text with name to Context of object and your state
     * @return void
     */
    public function setContext(string $context): void {
        $this->context = $context;
    }

    /**
     * @var string A text with the code of state object
     */
    protected $code;

    /**
     * @return string A text with the code of state object
     */
    public function getCode(): string {
        return $this->code;
    }

    /**
     * @param string $code A text with the code of state object
     * @return void
     */
    public function setCode(string $code): void {
        $this->code = $code;
        // Mount a message based in the status code
        $this->Message->DefineMessage($this);
    }

    /**
     * @var Message A instance of Message
     */
    public $Message;

    /**
     * @return Status An instance of Status
     */
    public function __construct() {
        $this->Message = new Message();
        $this->setContext("Factory");
        $this->setCode("NA");
    }

    /**
     * Execute a response with state of invalid request
     * @return void
     */
    public function InvalidRequest(): void {
        // Define status
        $this->setCode("NA");
        $this->Message->DefaultMessage($this);
        // Send response
        $this->ResponseJSON($_REQUEST, $this);
    }

    /**
     * Generate a log file in the pre-defined location
     * @return void
     */
    public function GenerateLogFile(): void {
        date_default_timezone_set("America/Sao_Paulo");
        $Date = new DateTime();

        $Destination = "./log-error.txt";
        $Message_Type = 3;

        $Message = join("   ", [
                    $Date->format("d/m/Y H:i:s"),
                    $this->getContext(),
                    $this->getCode(),
                    $this->Message->getContent()
                ]) . PHP_EOL;

        error_log($Message, $Message_Type, $Destination);
    }

    /**
     * Return a array with data of instance Status
     * @return array A array with data of instance Status
     */
    public function GetInstanceArray() {
        return [
            "context" => $this->getContext(),
            "code" => $this->getCode(),
            "Message" => $this->Message->GetInstanceArray()
        ];
    }

}
