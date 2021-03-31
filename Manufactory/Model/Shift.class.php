<?php

/**
 * Represents an instance of Shift
 * @uses DateTime
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Shift
{
    /**
     * @var int A number with the identifier of the Shift
     */
    private $id;

    /**
     * @return int A number with the identifier of the Shift
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id A number with the identifier of the Shift
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @var string A text with the code of Shift
     */
    private $code;

    /**
     * @return string A text with the code of Shift
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return void
     */
    public function setCode(string $code): void
    {
        $this->code = strtoupper(trim($code));
    }

    /**
     * @var string A text with the description of the Shift
     */
    private $description;

    /**
     * @return string A text with the description of the Shift
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description A text with the description of the Shift
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = ucwords(trim($description));
    }

    /**
     * @var int A number with the cursor to advances or foreards date of start shift
     */
    private $cursorStartDay;

    /**
     * @return int A number with the cursor to advances or foreards date of start shift
     */
    public function getCursorStartDay(): int
    {
        return $this->cursorStartDay;
    }

    /**
     * @param int $cursorStartDay A number with the cursor to advances or foreards date of start shift
     * @return void
     */
    public function setCursorStartDay(int $cursorStartDay): void
    {
        $this->cursorStartDay = $cursorStartDay;
    }

    /**
     * @var DateTime An instance of DateTime
     */
    private $StartDate;

    /**
     * @param string $StartDate A text with the formatted date to StartDate
     * @return void
     */
    public function setStartDate(string $StartDate): void
    {
        $StartDate = str_replace("/", "-", $StartDate);
        $this->StartDate->setTimestamp(strtotime($StartDate));
    }

    /**
     * @var int A number with the cursor to advances or foreards date of end shift
     */
    private $cursorEndDay;

    /**
     * @return int A number with the cursor to advances or foreards date of end shift
     */
    public function getCursorEndDay(): int
    {
        return $this->cursorEndDay;
    }

    /**
     * @param int $cursorEndDay A number with the cursor to advances or foreards date of end shift
     * @return void
     */
    public function setCursorEndDay(int $cursorEndDay): void
    {
        $this->cursorEndDay = $cursorEndDay;
    }

    /**
     * @var DateTime An instance of DateTime
     */
    private $EndDate;

    /**
     * @param string $EndDate An instance of DateTime
     * @return void
     */
    public function setEndDate(string $EndDate): void
    {
        $EndDate = str_replace("/", "-", $EndDate);
        $this->EndDate->setTimestamp(strtotime($EndDate));
    }

    /**
     * @var int A bit number to represents a boolean value of cut Shift
     */
    private $ofCut;

    /**
     * @return int A bit number to represents a boolean value of cut Shift
     */
    public function getOfCut(): int
    {
        return $this->ofCut;
    }

    /**
     * @param int $ofCut A bit number to represents a boolean value of cut Shift
     * @return void
     */
    public function setOfCut(int $ofCut): void
    {
        $this->ofCut = $ofCut;
    }

    /**
     * @var int A bit number to represents a boolean value of Shift in searches
     */
    private $ofSearch;

    /**
     * @return int A bit number to represents a boolean value of Shift in searches
     */
    public function getOfSearch(): int
    {
        return $this->ofSearch;
    }

    /**
     * @param int $ofSearch A bit number to represents a boolean value of Shift in searches
     * @return void
     */
    public function setOfSearch(int $ofSearch): void
    {
        $this->ofSearch = $ofSearch;
    }

    /**
     * @return Shift An instance of Shift
     */
    public function __construct()
    {
        $this->StartDate = new DateTime();
        $this->EndDate = new DateTime();
    }

    /**
     * Return a array with data of the instance Shift
     * @return array A array with data of the instance Shift
     */
    public function GetInstanceArray(): array
    {
        return [
            "id" => $this->getId(),
            "code" => $this->getCode(),
            "description" => $this->getDescription(),
            "cursorStartDay" => $this->getCursorStartDay(),
            "startDate" => $this->StartDate->format("Y-m-d H:i:s"),
            "cursorEndDay" => $this->getCursorEndDay(),
            "endDate" => $this->EndDate->format("Y-m-d H:i:s"),
            "ofCut" => $this->getOfCut(),
            "ofSearch" => $this->getOfSearch()
        ];
    }
}
