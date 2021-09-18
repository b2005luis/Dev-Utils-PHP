<?php

/**
 * Represents an instance of Contact in the system
 * @requires Category
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Contact
{
    /**
     * @var int A number with identifier to contact
     */
    protected $id;

    /**
     * @var Category An instance of Category
     */
    public $ContactType;

    /**
     * @var string A text with contact suplied
     */
    protected $contact;

    /**
     * @var string An explanation of contact representation
     */
    protected $description;

    /**
     * @return int A number with identifier to contact
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id A number with identifier to contact
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string A text with contact suplied
     */
    public function getContact(): string
    {
        return $this->contact;
    }

    /**
     * @param string $contact A text with contact suplied
     * @return void
     */
    public function setContact(string $contact): void
    {
        $this->contact = $contact;
    }

    /**
     * @return string An explanation of contact representation
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description An explanation of contact representation
     */
    public function setDescription(string $description): void
    {
        $this->description = ucwords(strtolower(trim($description)));
    }

    /**
     * Initialize an instance of Contact
     */
    public function __construct()
    {
        $this->ContactType = new Category();
    }

    /**
     * Generate an array with data of Contact
     * @return array An array with data of Contact
     */
    public function GetInstanceArray(): array
    {
        return [
            "id" => $this->getId(),
            "contact" => $this->getContact(),
            "ContactType" => $this->ContactType->GetInstanceArray(),
            "description" => $this->getDescription()
        ];
    }
}
