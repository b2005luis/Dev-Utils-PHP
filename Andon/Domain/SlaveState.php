<?php

/**
 * Representrs an instance of SlaveState
 * @author Luis Alberto Batista Pedroso
 */
class SlaveState
{
    /**
     * @var int A number with the identifier of SlaveState
     */
    private $id;

    /**
     * @var string A text with the description of SlaveState
     */
    private $name;

    /**
     * @var string A text with the default color of SlaveState
     */
    private $defaultColor;

    /**
     * @return int A number with the identifier of SlaveState
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id A number with the identifier of SlaveState
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string A text with the description of SlaveState
     */
    public function getName(): string
    {
        return utf8_decode($this->name);
    }

    /**
     * @param string $name A text with the description of SlaveState
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = strtoupper(strtolower(trim($name)));
    }

    /**
     * @return string A text with the default color of SlaveState
     */
    public function getDefaultColor(): string
    {
        return $this->defaultColor;
    }

    /**
     * @param string $defaultColor A text with the default color of SlaveState
     * @return void
     */
    public function setDefaultColor(string $defaultColor): void
    {
        $this->defaultColor = strtoupper($defaultColor);
    }

    /**
     * @return SlaveState An instance of SlaveState
     */
    public function __construct()
    {

    }

    /**
     * Return a array with tge data of instance SlaveState
     * @return array A array with the data of instance SlaveState
     */
    public function GetInstanceArray(): array
    {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "defaultColor" => $this->getDefaultColor(),
        ];
    }
}