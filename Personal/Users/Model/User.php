<?php

/**
 * Represents a User in the system
 * @requires Person
 * @requires Login
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class User extends Person {

    /**
     * @var Login An instance of Login
     */
    public $Login;

    /**
     * @var Contact List of contacts
     */
    public $Contacts;

    /**
     * @param Contact $Contact An instance of Contact
     */
    public function PushContact(Contact $Contact) {
        $this->Contacts = $Contact;
    }

    /**
     * @var bool A boolean value with session state of User
     */
    private $activated;

    /**
     * @return bool A boolean value with session state of User
     */
    public function getActivated(): bool {
        return $this->activated;
    }

    /**
     * @param bool $activated A boolean value with session state of User
     * @return void
     */
    public function setActivated(bool $activated): void {
        $this->activated = $activated;
    }

    /**
     * Initialize an instance of User
     */
    public function __construct() {
        parent::__construct();
        $this->Login = new Login();
        $this->Contacts = [];
    }

    /**
     * Generate and return a arrau with data of instance ofthe object
     * @return array A array with data of instance ofthe object
     */
    public function GetInstanceArray(): array {
        // Recue yhe super class instance
        $Person = parent::GetInstanceArray();

        // Generate array to contact list objects
        $ListOfContacts = [];
        foreach ($this->Contacts as $Contact) {
            $ListOfContacts[] = $Contact->GetInstanceArray();
        }

        // Set the array with data
        $InstanceOf = [
            "Contacts" => $ListOfContacts,
            "Login" => $this->Login->GetInstanceArray(),
            "activated" => $this->getActivated()
        ];

        // junta arrays das classes e monta array para Usuário
        return array_merge($Person, $InstanceOf);
    }

    /**
     * Recept and create an instance of User based in suplied array
     * @param array $InstanceOf A array with data of User
     */
    public function SetInstanceArray(array $InstanceOf) {
        $this->setId($InstanceOf["id"]);
        $this->setName($InstanceOf["firstName"]);
        $this->setLastName($InstanceOf["lastName"]);
        $this->setBirthday($InstanceOf["birthday"]);
        $this->setActivated(true);
        $this->Gender->setId($InstanceOf["Gender"]["id"]);
        $this->Gender->setCode($InstanceOf["Gender"]["code"]);
        $this->Gender->setDescription($InstanceOf["Gender"]["description"]);
        $this->Login->setUsername($InstanceOf["Login"]["username"]);
        $this->Login->setPassword($InstanceOf["Login"]["password"]);
        $this->Login->setLocked($InstanceOf["Login"]["locked"]);
    }

}
