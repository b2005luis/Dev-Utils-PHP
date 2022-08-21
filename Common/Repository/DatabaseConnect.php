<?php

/**
 * Implements one bridge of connection between PHP and SGDB's
 * @uses DatabaseDrivers
 * @uses PDO
 * @uses PDOException
 * @uses Status
 * @author Luis Alberto Batista Pedroso
 */
class DatabaseConnect
{
    /**
     * @var PDO Uma One instance of PDO
     */
    public $Connection;

    /**
     * @var Status A instanc of Status
     */
    public $Status;

    /**
     * @var string A text with one string connection with data source name
     */
    private $dataSourceName;

    /**
     * @var string A text with name of SGBD driver
     */
    private $driver;

    /**
     * @var string A text with name or IP of database server
     */
    private $hostname;

    /**
     * @var int A number of access port of database server
     */
    private $port;

    /**
     * @var string A text with name of datavase user
     */
    private $username;

    /**
     * @var string A text with password of database user
     */
    private $password;

    /**
     * @var string A text with name of database
     */
    private $database;

    /**
     * @param bool $auto_connect A boolean value with the decision if auto connect or not
     * @return DatabaseConnect A instance of DatabaseConnect
     */
    public function __construct($auto_connect = false)
    {
        $this->Status = new Status();
        $this->Status->setScope("Database");

        if ($auto_connect) {
            $this->autoConnect();
        }
    }

    /**
     * Get defaults settings of connection and execute the connection
     * @return void
     */
    function autoConnect(): void
    {
        $this->defaultCredencials();
        $this->openConnection();
    }

    /**
     * Define default data of connection
     * @return void
     */
    public function defaultCredencials(): void
    {
        $this->driver = DatabaseDrivers::DRV_MYSQL;
        $this->hostname = "localhost";
        $this->port = 3306;
        $this->username = "root";
        $this->password = "";
        $this->database = "test";
    }

    /**
     * Open and define one connection based on DSN (data source name)
     * @return void
     */
    public function openConnection(): void
    {
        try {
            // Switch DSN to equivalebt suplied driver
            $this->switchDataSource();
            // Initialize a new connection
            $this->Connection = new PDO($this->dataSourceName, $this->username, $this->password) or die(NULL);
            // If is a object, define traitment errors
            if ($this->Connection instanceof PDO) {
                // Define property errors as excetions
                $this->Connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Define state of object
                $this->Status->setCode("CONN");
            } else {
                // Define state of object
                $this->Status->setCode("NCONN");
            }
            // Define state of object
            $this->Status->Message->defineMessage($this->Status);
        } catch (PDOException $Error) {
            // Define state of object
            $this->Status->setCode($Error->getCode());
            $this->Status->Message->exceptionCatched($Error);
            $this->Status->generateLogFile();
        }
    }

    /**
     * Choose driver and define the string connection
     * @return void
     */
    public function switchDataSource(): void
    {
        switch ($this->driver) {
            case DatabaseDrivers::DRV_CUBRID:
                $this->dataSourceName = "$this->driver:dbname=$this->database;host=$this->hostname;port=$this->port";
                break;

            case DatabaseDrivers::DRV_SQLSERVER:
                $this->dataSourceName = "$this->driver:Server=$this->hostname;Database=$this->database";
                break;

            case DatabaseDrivers::DRV_FIREBIRD:
                $this->dataSourceName = "$this->driver:dbname=$this->hostname";
                break;

            case DatabaseDrivers::DRV_MYSQL:
                $this->dataSourceName = "$this->driver:host=$this->hostname;dbname=$this->database";
                break;

            case DatabaseDrivers::DRV_ORACLE_8:
                $this->dataSourceName = "$this->driver:dbname=$this->hostname/$this->database;charset=utf8";
                break;

            case DatabaseDrivers::DRV_ODBC:
                $this->dataSourceName = "$this->driver:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=$this->hostname;Uid=$this->usuario";
                break;

            case DatabaseDrivers::DRV_POSTGREE;
                $this->dataSourceName = "$this->driver:host=$this->hostname;port=$this->port;dbname=$this->database;";
                break;

            case DatabaseDrivers::DRV_SQLITE:
                $this->dataSourceName = "$this->driver:$this->hostname";
                break;

            default:
                $this->dataSourceName = NULL;
                break;
        }
    }

    /**
     * @return string A string connection with data source name
     */
    public function getDataSourceName(): string
    {
        return $this->dataSourceName;
    }

    /**
     * @param string $dataSourceName A string connection with data source name
     * @return void
     */
    public function setDataSourceName(string $dataSourceName): void
    {
        $this->dataSourceName = $dataSourceName;
    }

    /**
     * @return string A text with name of SGBD driver
     */
    public function getDriver(): string
    {
        return $this->driver;
    }

    /**
     * @param string $driver A text with name of SGBD driver
     * @return void
     */
    public function setDriver(string $driver): void
    {
        $this->driver = $driver;
    }

    /**
     * @return string A text with name or IP of database server
     */
    public function getHostname(): string
    {
        return $this->hostname;
    }

    /**
     * @param string $hostname A text with name or IP of database server
     * @return void
     */
    public function setHostname(string $hostname): void
    {
        $this->hostname = strtoupper(trim($hostname));
    }

    /**
     * @return int A number of access port of database server
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port A number of access port of database server
     * @return void
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }

    /**
     * @return string A text with name of datavase user
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username A text with name of datavase user
     * @return void
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string A text with password of database user
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password A text with password of database user
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string A text with name of database
     */
    public function getDatabase(): string
    {
        return $this->database;
    }

    /**
     * @param string $database A text with name of database
     */
    public function setDatabase(string $database): void
    {
        $this->database = $database;
    }

    /**
     * Test of connection state
     * @return bool A boolean value to represents the state connection
     */
    public function checkConnection(): bool
    {
        if ($this->Connection && $this->Status->getCode() == "CONN") {
            if ($this->Connection->query("SELECT 1")) {
                // Define state
                $this->Status->setCode("CONN");
                return true;
            } else {
                // Define state
                $this->Status->setCode("NCONN");
                return false;
            }
        } else {
            // Define state
            $this->Status->setCode("NCONN");
            return false;
        }
    }

    /**
     * Close  an opened connection
     */
    public function closeConnection(): void
    {
        try {
            // Set null to connection object
            $this->Connection = NULL;
            // // Define state of object
            $this->Status->setCode("NCONN");
        } catch (PDOException $Error) {
            // Define state of object
            $this->Status->setCode($Error->getCode());
            $this->Status->Message->exceptionCatched($Error);
            $this->Status->generateLogFile();
        }
    }
}