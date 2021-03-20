<?php

/**
 * Represents the Login in tge system
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Login {

    /**
     * @var string A text with username for User
     */
    protected $username;

    /**
     * @return string A text with username for User
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @param string $username A text with username for User
     * @return void
     */
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    /**
     * @var string A text with password for auth User
     */
    protected $password;

    /**
     * @return string A text with password for auth User
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * @param string $password A text with password for auth User
     * @return void
     */
    public function setPassword(string $password): void {
        $this->password = hash("SHA256", $password);
    }

    /**
     * @var bool A boolean value to kock state of User
     */
    protected $blocked;

    /**
     * @return bool A boolean value to kock state of User
     */
    public function getBlocked(): bool {
        return $this->blocked;
    }

    /**
     * @param bool $blocked A boolean value to kock state of User
     * @return void
     */
    public function setBlocked(bool $blocked): void {
        $this->blocked = $blocked;
    }

    /**
     * Initialize an instance of Login
     */
    public function __construct() {
        $this->setBlocked(false);
    }

    /**
     * Generate and return a array with data of instance
     * @return array A array with data of instance
     */
    public function GetInstanceArray(): array {
        return [
            "username" => $this->getUsername(),
            "password" => $this->getPassword(),
            "blocked" => $this->getBlocked()
        ];
    }

}
