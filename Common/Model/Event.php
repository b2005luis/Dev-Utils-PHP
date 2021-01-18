<?php

/**
 * Represents a event of some ocurrencie in the system
 * @author Luis Alberto Batisat Pedroso <b2005.luis@gmail.com>
 */
class Event {

    /**
     * @var int A number of identifier to event
     */
    private $id;

    /**
     * @return int A number of identifier to event
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return int A number of identifier to event
     * @return void
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * @var string A text with code to event
     */
    private $code;

    /**
     * @return string A text with code to event
     */
    public function getCode(): string {
        return $this->code;
    }

    /**
     * @param string $code An text with code to event
     * @return void
     */
    public function setCode(string $code): void {
        $this->code = strtoupper(trim($code));
    }

    /**
     * @var string A text with description of event
     */
    private $description;

    /**
     * @return string A text with description of event
     */
    public function getDescription(): string {
        return $this->description;
    }

    /**
     * @param string $description A text with description of event
     * @return void
     */
    public function setDescription(string $description): void {
        $this->description = ucwords(trim($description));
    }

    /**
     * Return a array with data of instance of Event
     * @return array A array eith data of instance of object
     */
    public function GetInstanceArray(): array {
        return [
            "id" => $this->getId(),
            "code" => $this->getCode(),
            "description" => $this->getDescription()
        ];
    }

}
