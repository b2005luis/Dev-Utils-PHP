<?php

/**
 * Implement an instance of Lead
 * @author Luis Alberto Batista Pedroso
 */
class Lead
{
    /**
     * @var int A number with the identifier of Leed
     */
    private $id;

    /**
     * @var string A text with the name of Lead
     */
    private $name;

    /**
     *
     * @var string A text with phone number of Lead
     */
    private $phone;

    /**
     * @var string A text with e-mail of Lead
     */
    private $email;

    /**
     * Initialize an instance of Lead
     */
    public function __construct()
    {

    }

    /**
     * @return int A number with the identifier of Leed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id A number with the identifier of Leed
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string A text with the name of Lead
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name A text with the name of Lead
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = ucwords(trim($name));
    }

    /**
     * @return string A text with phone number of Lead
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone A text with phone number of Lead
     * @return void
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string A text with e-mail of Lead
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email A text with e-mail of Lead
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = strtolower($email);
    }
}