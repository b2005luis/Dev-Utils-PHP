<?php

/**
 * Represents an instance of MachineSetting
 * @requires DateTime
 * @requires Product
 * @author Luis Alberto Batista Pedroso
 */
class MachineSetting {

    /**
     * @var int A number with the identifier of DeviceSetting
     */
    private $id;

    /**
     * @return int A number with the identifier of DeviceSetting
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id A number with the identifier of DeviceSetting
     * @return void
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * @var DateTime An instance of DateTime
     */
    private $Date;

    /**
     * @param string $data Atext with a date
     * @return void
     */
    public function setDate(string $data): void {
        $data = str_replace("/", "-", $data);
        $this->Date->setTimestamp(strtotime($data));
    }

    /**
     * @var float A decimal number with the speed rotation of machine
     */
    private $speed;

    /**
     * @return float A decimal number with the speed rotation of machine
     */
    public function getSpeed(): float {
        return $this->speed;
    }

    /**
     * @param string $speed Conjunto de caractres devimais com a vecidade de uma máquina SlaveDevice.
     * @return void
     */
    public function setSpeed(string $speed): void {
        $speed = str_replace(",", ".", $speed);

        if (is_numeric($speed)) {
            $speed = number_format($speed, 2, ".", "");
        }

        $this->speed = $speed;
    }

    /**
     * @var Product An instance of Product
     */
    public $Product;

    /**
     * @var float A decimal number with target of machine performance
     */
    private $target;

    /**
     * @return float A decimal number with target of machine performance
     */
    public function getTarget(): float {
        return $this->target;
    }

    /**
     * @param string $target A decimal number with target of machine performance
     * @return void
     */
    public function setTarget(string $target): void {
        $target = str_replace(",", ".", $target);

        if (is_numeric($target)) {
            $target = number_format($target, 2, ".", "");
        }

        $this->target = $target;
    }

    /**
     * @return MachineSetting An instance of MachineSetting
     */
    public function __construct() {
        date_default_timezone_set("America/Sao_Paulo");
        $this->Date = new DateTime();
        $this->Product = new Product();
    }

    /**
     * Return a array with the data of instance MachineSetting
     * @return array A array with the data of instance MachineDevice
     */
    public function GetInstanceArray(): array {
        return [
            "id" => $this->getId(),
            "date" => $this->Date->format("Y-m-d H:i:s"),
            "speed" => $this->getSpeed(),
            "target" => $this->getTarget(),
            "Product" => $this->Product->GetInstanceArray()
        ];
    }

}
