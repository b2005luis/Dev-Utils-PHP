<?php

/**
 * Implement an instance of Quotes
 * @requires DateTime
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Quotes {

    /**
     * @var int A number with the identifier of quotes
     */
    private $id;

    /**
     * @return int A number with the identifier of quotes
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id A number with the identifier of quotes
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
     * @param string $date A text with a fomatted date
     */
    public function setDate(string $date): void {
        $date = str_replace("/", "-", $date);
        $this->Date->setTimestamp(strtotime($date));
    }

    /**
     * @var float A numver with the price of the quotes
     */
    private $price;

    /**
     * @return float A numver with the price of the quotes
     */
    public function getPrice(): float {
        return $this->price;
    }

    /**
     * @param string $price A numver with the price of the quotes
     * @return void
     */
    public function setPrice(string $price): void {
        $price = str_replace(",", ".", $price);
        $this->price = number_format($price, 2, ".", "");
    }

    /**
     * @var float A number with the percent of variation of price quotes
     */
    private $change;

    /**
     * @return float A number with the percent of variation of price quotes
     */
    public function getChange(): float {
        return $this->change;
    }

    /**
     * @param string $change A number with the percent of variation of price quotes
     * @return void
     */
    public function setChange(string $change): void {
        $change = str_replace(",", ".", $change);
        $this->change = number_format($change, 2, ".", "");
    }

    /**
     * @var float A number with the volume moved in the market
     */
    private $volume;

    /**
     * @return float A number with the volume moved in the market
     */
    public function getVolume(): float {
        return $this->volume;
    }

    /**
     * @param string $volume A number with the volume moved in the market
     * @return void
     */
    public function setVolume(string $volume): void {
        $volume = str_replace(",", ".", $volume);
        $this->volume = number_format($volume, 2, ".", "");
    }

    /**
     * Initialize an instance of Quotes
     */
    public function __construct() {
        $this->Date = new DateTime();
    }

    /**
     * Return a array with the data of instance Quotes
     * @return array A array with the data of instance Quotes
     */
    public function GetInstanceArray(): array {
        return [
            "id" => $this->getId(),
            "date" => $this->Date->format("Y-m-d"),
            "price" => $this->getPrice(),
            "change" => $this->getChange(),
            "volume" => $this->getVolume()
        ];
    }

}
