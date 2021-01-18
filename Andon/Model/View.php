<?php

/**
 * Represents an instance of View
 * @requires SlaveDevice
 * @author Luis Alberto Batista Pedroso
 */
class View {

    /**
     * @var int A number with the identifier of View
     */
    private $id;

    /**
     * @return int A number with the identifier of View
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id A number with the identifier to View
     * @return void
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * @var string A text with the name of View
     */
    private $name;

    /**
     * @return string A text with the name of View
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name A text with the name of View
     * @return void
     */
    public function setName(string $name): void {
        $this->name = ucwords(trim($name));
    }

    /**
     * @var SlaveDevice A list with devices of View
     */
    public $ListOfDevices;

    /**
     * @param SlaveDevice $Device An instance of SlaveDevice
     * @return void
     */
    public function AddSlaveDevice(SlaveDevice $Device): void {
        $this->ListOfDevices[] = $Device;
    }

    /**
     * @return View An instance of View
     */
    public function __construct() {
        $this->ListOfDevices = [];
    }

    /**
     * Return a array with the data of instance View
     * @return array A array with the data of instance of View
     */
    public function GetInstanceArray(): array {
        $ListOfDevices = [];

        foreach ($this->ListOfDevices as $Device) {
            $ListOfDevices[] = $Device->GetInstanceArray();
        }

        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "ListOfDevices" => $ListOfDevices
        ];
    }

}
