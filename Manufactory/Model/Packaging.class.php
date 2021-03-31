<?php

/**
 * Represents an instance of Packaging
 * @uses Category
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Packaging
{

    /**
     * @var int A number with the data of the instance of Pacjaging
     */
    private $id;

    /**
     * @return int A number with the data of the instance of Pacjaging
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id A number with the data of the instance of Pacjaging
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @var string A text with the packaging code
     */
    private $code;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code A text with the packaging code
     * @return void
     */
    public function setCode(string $code): void
    {
        $this->code = strtoupper(trim($code));
    }

    /**
     *
     * @var string A text with the description of Packaging
     */
    private $description;

    /**
     * @return string A text with the description of Packaging
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description A text with the description of Packaging
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = ucwords(trim($description));
    }

    /**
     * @var int A number with the quantity in packaging
     */
    private $quantity;

    /**
     * @return int A number with the quantity in packaging
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity A number with the quantity in packaging
     * @return void
     */
    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @var float A number with the weight of packaging
     */
    private $weight;

    /**
     * @return float A number with the weight of packaging
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param float $weight A number with the weight of packaging
     * @return void
     */
    public function setWeight(float $weight): void
    {
        $weight = str_replace(",", ".", $weight);

        if (is_numeric($weight)) {
            $weight = number_format($weight, 3, ",", "");
        }

        $this->weight = $weight;
    }

    /**
     * @var Category An instance of Category to represents unit measure of packaging
     */
    private $UnitMeasure;

    /**
     * @return Packaging An instance of Packaging
     */
    public function __construct()
    {
        $this->UnitMeasure = new Category();
    }

    /**
     * @return array A array with the data of instance Packaginh
     */
    public function GetInstanceArray(): array
    {
        return [
            "id" => $this->getId(),
            "code" => $this->getCode(),
            "description" => $this->getDescription(),
            "quantity" => $this->getQuantity(),
            "weight" => $this->getWeight(),
            "UnitMeasure" => $this->UnitMeasure->GetInstanceArray()
        ];
    }
}
