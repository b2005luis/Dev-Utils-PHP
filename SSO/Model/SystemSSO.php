<?php

/**
 * Responsible by manager sessions in the system
 * @requires Status
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class SystemSSO {

    /**
     * @var string A text or number to represent key of session
     */
    protected $key;

    /**
     * @return string A text or number to represent key of session
     */
    public function getKey(): string {
        return $this->key;
    }

    /**
     * @param string $key A text or number to represents key session
     * @return void
     */
    public function setKey(string $key): void {
        $this->key = $key;
    }

    /**
     * @var Status An instance of Status
     */
    public $Status;

    /**
     * Initializa an instance of SystemSSO
     */
    public function __construct(string $key = "System") {
        // Define the default key of session
        $this->setKey($key);
        // initialize an instance of Status
        $this->Status = new Status();
        // Initialize the controls of session storage in the system
        if (!isset($_SESSION)) {
            session_start();
        }
    }

    /**
     * Check if the key session exists
     * @return boolean A boolean value to response if a sesssion is valid or not
     */
    public function CheckSession(): bool {
        if (isset($_SESSION[SESSION_NAME][$this->getKey()])) {
            // Define status
            $this->Status->setCode("SOK");
            return TRUE;
        } else {
            // Define status
            $this->Status->setCode("SND");
            return FALSE;
        }
    }

    /**
     * Asign a new session based in session name and our keu value
     * @param mixed $valueOf A value of session. Can any value or object or arrau
     * @return void
     */
    public function CreateSession($valueOf): void {
        // Define the content session
        $_SESSION[SESSION_NAME][$this->getKey()] = $valueOf;
        // Define status
        $this->CheckSession();
    }

    /**
     * Recover and returns the value of an asigned session
     * @return mixed A value of session based in session name and key
     * @return mixed Any value of session based in yhe session ma,e and our key value
     */
    public function RecoverySession() {
        // Validade the state of session
        $this->CheckSession();

        if ($this->Status->getCode() == "SOK") {
            // Define status
            $this->Status->setCode("SOK");
            // returning the content of defined session
            return $_SESSION[SESSION_NAME][$this->key];
        } else {
            // Define status
            $this->Status->setCode("SND");
            // returning null because the session is not defined
            return NULL;
        }
    }

    /**
     * unsign a current defined sesssion
     * @return void
     */
    public function DiscardSession(): void {
        // Validate if the session is valid
        $this->CheckSession();

        if ($this->Status->getCode() == "SOK") {
            // unsign the defined session content
            unset($_SESSION[SESSION_NAME][$this->getKey()]);
            // Define status
            $this->Status->setCode("SND");
        }
    }

}
