<?php

/**
 * Implements the abstraction of a User
 * @uses Person
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

    /**
     * @return array An array with data of this instance of the User
     */
    public function GetInstanceArray(): array
    {
        $Person = parent::GetInstanceArray();
        $ListOfContacts = [];
        foreach ($this->Contacts as $Contact) {
            $ListOfContacts[] = $Contact->GetInstanceArray();
        }
        $InstanceOf = [
            "Contacts" => $ListOfContacts,
            "Login" => $this->Login->GetInstanceArray(), "activated" => $this->isActivated()
        ];
        return array_merge($Person, $InstanceOf);
    }

    /**
     * @param array $InstanceOf An array with data of this instance of the User
     * @return void
     */
    public function SetInstanceArray(array $InstanceOf): void
    {
        $this->setId($InstanceOf["id"]);
        $this->setFirstname($InstanceOf["firstName"]);
        $this->setLastName($InstanceOf["lastName"]);
        $this->setBirthday($InstanceOf["birthday"]);
        $this->setActivated(true);
        $this->Gender->setId($InstanceOf["Gender"]["id"]);
        $this->Gender->setCode($InstanceOf["Gender"]["code"]);
        $this->Gender->setDescription($InstanceOf["Gender"]["description"]);
        $this->Login->setUsername($InstanceOf["Login"]["username"]);
        $this->Login->setPassword($InstanceOf["Login"]["password"]);
        $this->Login->setBlocked($InstanceOf["Login"]["locked"]);
    }
}