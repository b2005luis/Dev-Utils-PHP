<?php

/**
 * Represents an instance of SlaveDevice
 * @requires Server
 * @requires MachineSetting
 * @author Luis Alberto Batista Pedroso
 */
class SlaveDevice {

    /**
     * @var int A number with the identifier of SlaveDevice
     */
    private $id;

    /**
     * @return int A number with the identifier of SlaveDevice
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id A number with the identifier of SlaveDevice
     * @return void
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * @var string A text with the description of SlaveDevice
     */
    private $name;

    /**
     * @return string A text with the description of SlaveDevice
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name A text with the description of SlaveDevice
     * @return void
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * @var string A text with the MAC address of SlaveDevice
     */
    private $MAC;

    /**
     * @return string A text with the MAC address of SlaveDevice
     */
    public function getMAC(): string {
        return $this->MAC;
    }

    /**
     * @param string $MAC A text with the MAC address of SlaveDevice
     * @return void
     */
    public function setMAC(string $MAC): void {
        $this->MAC = $MAC;
    }

    /**
     * @var MachineSetting An insntance of SlaveDevice Settings
     */
    public $Setting;

    /**
     * @return SlaveDevice An instance of SlaveDevice
     */
    public function __construct() {
        $this->Setting = new MachineSetting();
    }

    /**
     * Return the array with the data of instance of SlaveDevice
     * @return array A arrau with the data of instance of SlaveDevice
     */
    public function GetInstanceArray(): array {
        return [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "MAC" => $this->getMAC(),
            "Setting" => $this->Setting->GetInstanceArray()
        ];
    }

}
