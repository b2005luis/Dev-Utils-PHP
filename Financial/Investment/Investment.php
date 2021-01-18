<?php

/**
 * Represents an instance of Investment
 * @requires DateTime
 * @requires Category
 * @requires Broker
 * @requires Asset
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Investment {

    /**
     * @var int A number with identifier of investment
     */
    private $id;

    /**
     * @return int A number with identifier of investment
     */
    function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id A number with identifier of investment
     * @return void
     */
    function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * @var DateTime An instance of DateTime
     */
    private $Date;

    /**
     * @param string $date A text with the formatted date
     * @return void
     */
    function setDate(string $date): void {
        $date = str_replace("/", "-", $date);
        $this->Date->setTimestamp(strtotime($date));
    }

    /**
     * @var Category An instance of Category that represents the transaction type
     */
    private $TransactionType;

    /**
     * @var int A number with assets buyed or selled in the transaction
     */
    private $quantity;

    /**
     * @return int A number with assets buyed or selled in the transaction
     */
    function getQuantity(): int {
        return $this->quantity;
    }

    /**
     * @param int $quantity A number with assets buyed or selled in the transaction
     * @return void
     */
    function setQuantity(int $quantity): void {
        $this->quantity = $quantity;
        // Define the total value
        $temp = ($this->getQuantity() * $this->getValue()) + $this->getTaxes();
        $this->setTaxes($taxes);
    }

    /**
     * @var float A float number with value of investment
     */
    private $value;

    /**
     * @return float A float number with value of investment
     */
    function getValue(): float {
        return $this->value;
    }

    /**
     * @param string $value A number with value of investment
     * @return void
     */
    function setValue(string $value): void {
        $value = str_replace(",", ".", $value);
        $this->value = number_format($value, 2, ".", "");
        // Define the total value
        $temp = ($this->getQuantity() * $this->getValue()) + $this->getTaxes();
        $this->setTaxes($taxes);
    }

    /**
     * @var float A float value of taxes payded in the investment
     */
    private $taxes;

    /**
     * @return float A float value of taxes payded in the investment
     */
    function getTaxes(): float {
        return $this->taxes;
    }

    /**
     * @param string $taxes A float value of taxes payded in the investment
     * @return void
     */
    function setTaxes(string $taxes): void {
        $taxes = str_replace(",", ".", $taxes);
        $this->taxes = number_format($taxes, 2, ".", "");
    }

    /**
     * @var float A number with the total of investments
     */
    private $total;

    /**
     * @return float A number with the total of investments
     */
    public function getTotal(): float {
        return $this->total;
    }

    /**
     * @param string $total A number with the total of investments
     * @return void
     */
    public function setTotal(string $total): void {
        $total = str_replace(",", ".", $total);
        $this->total = number_format($total, 2, ".", "");
    }

    /**
     * @var Broker An instance of Broker
     */
    public $Broker;

    /**
     * @var Asset An instance of Asset
     */
    public $Asset;

    /**
     * @return Investment An instance of Investment
     */
    public function __construct() {
        $this->Date = new DateTime();
        $this->TransactionType = new Category();
        $this->Broker = new Broker();
        $this->Asset = new Asset();
    }

    /**
     * Return a array with the data of instance Investment
     * @return array A array with the data of instance Investment
     */
    public function GetInstanceArray(): array {
        return [
            "id" => $this->getId(),
            "date" => $this->Date->format("Y-m-d"),
            "TransactionType" => $this->TransactionType->GetInstanceArray(),
            "quantity" => $this->getQuantity(),
            "value" => $this->getValue(),
            "taxes" => $this->getTaxes(),
            "total" => $this->getTotal(),
            "Broker" => $this->Broker->GetInstanceArray(),
            "Asset" => $this->Asset->GetInstanceArray()
        ];
    }

}
