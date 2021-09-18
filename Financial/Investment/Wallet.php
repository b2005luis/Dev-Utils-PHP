<?php

/**
 * Represents an instance of Wallet
 * @requires User
 * @requires Investment
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Wallet
{
    /**
     * @var User An instance of User
     */
    public $Owner;

    /**
     * @var array An array with all instances of Investment
     */
    public $listOfInvestments;

    /**
     * @var int A number with identifier of Wallet
     */
    protected $ID;

    /**
     * @var string A text with name of the Wallet
     */
    protected $name;

    /**
     * @var int A number with quantity of assets in the wallet
     */
    protected $quantityAssets;

    /**
     * @var float A number with profitability of the wallet
     */
    protected $profitability;

    /**
     * Initialize an instance of Wallet
     */
    public function __construct()
    {
        $this->setID("");
        $this->setProfitability(0.0);
        $this->Owner = new User();
        $this->listOfInvestments = [];
    }

    /**
     * Add a new investment in the list of investiments
     * @param Investment $Investment An instance of Insvestiment
     */
    public function PushNewInvestment(Investment $Investment): void
    {
        $this->listOfInvestments[] = $Investment;
        $this->setQuantityAssets();
    }

    /**
     * Get an item in list of investments based in index number
     * @param int $index A number with index of item in list of investments
     * @return Investment|null An instance of Investment
     */
    public function getInvestment(int $index): Investment
    {
        return $this->listOfInvestments[$index];
    }

    /**
     * @return array A array with data of wallet object
     */
    public function GetInstanceArray(): array
    {
        return [
            "ID" => $this->getID(),
            "name" => $this->getName(),
            "quantityAssets" => $this->getQuantityAssets(),
            "profitability" => $this->getProfitability(),
            "Owner" => $this->Owner->GetInstanceArray()
        ];
    }

    /**
     * @return int A number with identifier of the Wallet
     */
    public function getID(): int
    {
        return $this->ID;
    }

    /**
     * @param int $ID A number with identifier of the Wallet
     * @return void
     */
    public function setID(int $ID): void
    {
        $this->ID = $ID;
    }

    /**
     * @return string A text with name of the Wallet
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name A text with name of the Wallet
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = ucwords($name);
    }

    /**
     * @return int A number with quantity of assets in the wallet
     */
    public function getQuantityAssets(): int
    {
        return $this->quantityAssets;
    }

    /**
     * Define the quantity of assets in the wallet
     * @return void
     */
    public function setQuantityAssets(): void
    {
        $this->quantityAssets = count($this->listOfInvestments);
    }

    /**
     * @return float A number with profitability of the wallet
     */
    public function getProfitability(): float
    {
        return $this->profitability;
    }

    /**
     * @param float $profitability A number with profitability of the wallet
     * @return void
     */
    public function setProfitability(float $profitability): void
    {
        $this->profitability = $profitability;
    }

}
