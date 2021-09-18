<?php

/**
 * Represent an instance of Broker
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Broker
{
    /**
     * @var int A number with identifier of Broker
     */
    private $id;

    /**
     * @var string A text with name of Broker
     */
    private $name;

    /**
     * @var string A text with description of Broker
     */
    private $description;

    /**
     * @return int A number with identifier of Broker
     */
    function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id A number with identifier of Broker
     * @return void
     */
    function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string A text with name of Broker
     */
    function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name A text with name of Broker
     * @return void
     */
    function setName(string $name): void
    {
        $this->name = ucwords(trim($name));
    }

    /**
     * @return string A text with description of Broker
     */
    function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description A text with description of Broker
     * @return void
     */
    function setDescription(string $description): void
    {
        $this->description = ucwords(trim($description));
    }

    /**
     * @return array A array with the data of instance Broker
     */
    public function GetInstanceArray(): array
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "description" => $this->getDescription()
        ];
    }

}
