<?php

/**
 * Represents a instance of Server
 * @requires DateTime Class of DateTime
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Server
{
    /**
     * @var int A number with the indentifier of Server
     */
    private $id;

    /**
     * @var string A text eith the Hostname\Instance to connect in the Server
     */
    private $hostname;

    /**
     * @var string A text with the description of Server
     */
    private $description;

    /**
     * @var string A text with the username to connect in the database
     */
    private $username;

    /**
     * @var string A text with the password to connect in the database
     */
    private $password;

    /**
     * @var string A text with the database name to connect
     */
    private $database;

    /**
     * @var DateTime A instance of DateTime to sync date of the Server
     */
    private $LastUpdate;

    /**
     * @return Server A instance of Server
     */
    public function __construct()
    {
        $this->LastUpdate = new DateTime();
    }

    /**
     * @param string $date A date representation like text
     * @return void
     */
    public function setLastUpdate(string $date): void
    {
        $date = str_replace("/", "-", $date);
        $this->LastUpdate->setTimestamp(strtotime($date));
    }

    /**
     * Return a array with the data of instabnce Server
     * @return array A array with the data of instabnce Server
     */
    public function GetInstanceArray(): array
    {
        return [
            "id" => $this->getId(),
            "description" => $this->getDescription(),
            "hostname" => $this->getHostname(),
            "username" => $this->getUsername(),
            "password" => $this->getPassword(),
            "database" => $this->getDatabase(),
            "lastUpdate" => $this->LastUpdate->format("Y-m-d H:i:s")
        ];
    }

    /**
     * @return int A number with the indentifier of Server.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id A number with the indentifier of Server
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string A text with the description of Server
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description A text with the description of Server
     * @return void
     */
    public function setDescription(string $description): void
    {
        $this->description = ucwords(trim($description));
    }

    /**
     * @return string A text eith the Hostname\Instance to connect in the Server
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }

    /**
     * @param string $hostname A text with the Hostname\Instance to connect in the Server
     * @return void
     */
    public function setHostname(string $hostname): void
    {
        $this->hostname = strtoupper(trim($hostname));
    }

    /**
     * @return string A text with the username to connect in the database
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username A text with the username to connect in the database
     * @return void
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string A text with the password to connect in the database
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password A text with the password to connect in the database
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string A text with the database name to connect
     */
    public function getDatabase(): string
    {
        return $this->database;
    }

    /**
     * @param string $name A text with the database name to connect
     * @return void
     */
    public function setDatabase(string $database): void
    {
        $this->database = $database;
    }
}