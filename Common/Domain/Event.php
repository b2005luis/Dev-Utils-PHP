<?php

/**
 * Represents a event of some ocurrencie in the system
 * @author Luis Alberto Batisat Pedroso <b2005.luis@gmail.com>
 */
class Event
{
    /**
     * @var int A number of identifier to event
     */
    private $id;

    /**
     * @var string A text with code to event
     */
    private $code;

    /**
     * @var string A text with description of event
     */
    private $description;

    /**
     * @return int A number of identifier to event
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int A number of identifier to event
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string A text with code to event
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code An text with code to event
     * @return void
     */
    public function setCode(string $code): void
    {
        $this->code = strtoupper(trim($code));
    }

    /**
     * @return string A text with description of event
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description A text with description of event
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = ucwords(trim($description));
    }
}