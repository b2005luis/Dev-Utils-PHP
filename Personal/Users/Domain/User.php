<?php

/**
 * Implements the abstraction of a User
 * @uses Person
 * @uses Contact
 * @uses Login
 * @author Luis Alberto Batista Pedroso
 */
class User extends Person
{
    /**
     * @var Login An instance of Login
     */
    public $Login;

    /**
     * @var Contact An isntance of Contact
     */
    public $Contacts;

    /**
     * @var bool A boolean value for status of User like activated
     */
    private $activated;

    /**
     * @param Contact $Contact An isntance of Contact
     * @return void
     */
    public function PushContact(Contact $Contact): void
    {
        $this->Contacts = $Contact;
    }

    /**
     * @return bool A boolean value for status of User like activated
     */
    public function isActivated(): bool
    {
        return $this->activated;
    }

    /**
     * @param bool $activated A boolean value for status of User like activated
     * @return void
     */
    public function setActivated(bool $activated): void
    {
        $this->activated = $activated;
    }

    /**
     * Initialize an instance of User
     */
    public function __construct()
    {
        parent::__construct();
        $this->Login = new Login();
        $this->Contacts = [];
    }
}