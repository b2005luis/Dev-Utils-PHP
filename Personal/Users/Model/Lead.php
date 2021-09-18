<?php

/**
 * Implement an instance of Lead
 * @author Luis Alberto Batista Pedroso
 */
class Lead
{
    /**
     * @var string A text with the mode as ARRAY to return one instance of class
     */
    const ARRAY = "File:ARRAY";

    /**
     * @var string A text with the mode as CSV to return one instance of class
     */
    const CSV = "File:CSV";

    /**
     * @var string A text with the mode as JSON to return one instance of class
     */
    const JSON = "File:JSON";

    /**
     * @var int A number with the identifier of Leed
     */
    private $id;

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
     * @var string A text with the name of Lead
     */
    private $name;

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
        $this->name = ucwords(strtolower($name));
    }

    /**
     *
     * @var string A text with phone number of Lead
     */
    private $phone;

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
     * @var string A text with e-mail of Lead
     */
    private $email;

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

    /**
     * Initialize an instance of Lead
     */
    public function __construct()
    {
    }

    /**
     * Get an instance of Lead based in our mode
     * @param string $name A text with the mode of return for an instance
     * @return mixed A array, json or text csv formatted as a instance of class
     */
    public function GetInstanceArray(string $mode = Lead::ARRAY): mixed
    {
        /**
         * Mounts the array with the data of instance
         */
        $InstanceOf = [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "phone" => $this->getPhone(),
            "email" => $this->getEmail()
        ];

        switch ($mode) {
            case Lead::ARRAY:
                return $InstanceOf;

            case Lead::CSV:
                return join(";", $InstanceOf) . PHP_EOL;

            case Lead::JSON:
                return json_encode($InstanceOf);

            default:
                return $InstanceOf;
        }
    }
}
