<?php

/**
 * Responsible by manager sessions in the system
 * @uses Status
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
        $this->setKey($key);
        $this->Status = new Status();
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
            $this->Status->setCode("SOK");
            return TRUE;
        } else {
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
        $_SESSION[SESSION_NAME][$this->getKey()] = $valueOf;
        $this->CheckSession();
    }

    /**
     * Recover and returns the value of an asigned session
     * @return mixed A value of session based in session name and key
     * @return mixed Any value of session based in yhe session ma,e and our key value
     */
    public function RecoverySession() {
        $this->CheckSession();

        if ($this->Status->getCode() == "SOK") {
            $this->Status->setCode("SOK");
            return $_SESSION[SESSION_NAME][$this->key];
        } else {
            $this->Status->setCode("SND");
            return NULL;
        }
    }

    /**
     * unsign a current defined sesssion
     * @return void
     */
    public function DiscardSession(): void {
        $this->CheckSession();

        if ($this->Status->getCode() == "SOK") {
            unset($_SESSION[SESSION_NAME][$this->getKey()]);
            $this->Status->setCode("SND");
        }
    }

}
