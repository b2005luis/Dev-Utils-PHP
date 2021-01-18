<?php

/**
 * Implements one bridge of connection between PHP and SGDB's
 * @requires PDO
 * @requires PDOException
 * @requires Status
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class DatabaseConnect {

    /**
     * Vaalue of driver Client Cubrid
     * @var string A text with value fo driver Client Cubrid
     */
    public const DRV_CUBRID = "cubrid";

    /**
     * Vaalue of driver Client SQL Server
     * @var string A text with value fo driver Client SQL Server
     */
    public const DRV_SQLSERVER = "sqlsrv";

    /**
     * Vaalue of driver Client Firebird
     * @var string A text with value fo driver Client Firebird
     */
    public const DRV_FIREBIRD = "firebird";

    /**
     * Vaalue of driver Client MySQL
     * @var string A text with value fo driver Client MySQL
     */
    public const DRV_MYSQL = "mysql";

    /**
     * Vaalue of driver Oracle Client 8+
     * @var string A text with value fo driver Oracle Client 8+
     */
    public const DRV_ORACLE_8 = "oci8";

    /**
     * Vaalue of driver Client ODBC
     * @var string A text with value fo driver Client ODBC
     */
    public const DRV_ODBC = "odbc";

    /**
     * Vaalue of driver Client Postgree SQL
     * @var string A text with value fo driver Client Postgree SQL
     */
    public const DRV_POSTGREE = "pgsql";

    /**
     * Vaalue of driver Client SQLite
     * @var string A text with value fo driver Client SQLite
     */
    public const DRV_SQLITE = "sqlite";

    /**
     * A instance of PDO
     * @var PDO Uma One instance of PDO
     */
    public $Connection;

    /**
     * @var string A text with one string connection with data source name
     */
    private $DSN;

    /**
     * @return string A string connection with data source name
     */
    public function getDSN(): string {
        return $this->DSN;
    }

    /**
     * @param string $DSN A string connection with data source name
     * @return void
     */
    public function setDSN(string $DSN): void {
        $this->DSN = $DSN;
    }

    /**
     * @var string A text with name of SGBD driver
     */
    private $driver;

    /**
     * @return string A text with name of SGBD driver
     */
    public function getDriver(): string {
        return $this->driver;
    }

    /**
     * @param type $driver A text with name of SGBD driver
     * @return void
     */
    public function setDriver(string $driver): void {
        $this->driver = $driver;
    }

    /**
     * @var string A text with name or IP of database server
     */
    private $hostname;

    /**
     * @return string A text with name or IP of database server
     */
    public function getHostname(): string {
        return $this->hostname;
    }

    /**
     * @param string $hostname A text with name or IP of database server
     * @return void
     */
    public function setHostname(string $hostname): void {
        $this->hostname = strtoupper(trim($hostname));
    }

    /**
     * @var int A number of access port of database server
     */
    private $port;

    /**
     * @return int A number of access port of database server
     */
    public function getPort(): int {
        return $this->port;
    }

    /**
     * @param int $port A number of access port of database server
     * @return void
     */
    public function setPort(int $port): void {
        $this->port = $port;
    }

    /**
     * @var string A text with name of datavase user
     */
    private $username;

    /**
     * @return string A text with name of datavase user
     */
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * @param string $username A text with name of datavase user
     * @return void
     */
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    /**
     * @var string A text with password of database user
     */
    private $password;

    /**
     * @return string A text with password of database user
     */
    public function getPassword(): string {
        return $this->password;
    }

    /**
     * @param string $password A text with password of database user
     * @return void
     */
    public function setPassword(string $password): void {
        $this->password = $password;
    }

    /**
     * @var string A text with name of database
     */
    private $database;

    /**
     * @return string A text with name of database
     */
    public function getDatabase(): string {
        return $this->database;
    }

    /**
     * @param string $database A text with name of database
     */
    public function setDatabase(string $database): void {
        $this->database = $database;
    }

    /**
     * @var Status A instanc of Status
     */
    public $Status;

    /**
     * @param bool $auto_connect A boolean value with the decision if auto connect or not
     * @return DatabaseConnect A instance of DatabaseConnect
     */
    public function __construct($auto_connect = false) {
        $this->Status = new Status();
        $this->Status->setContext("Database");

        if ($auto_connect) {
            $this->AutoConnect();
        }
    }

    /**
     * Get defaults settings of connection and execute the connection
     * @return void
     */
    function AutoConnect(): void {
        $this->DefaultCredencials();
        $this->OpenConnection();
    }

    /**
     * Define default data of connection
     * @return void
     */
    public function DefaultCredencials(): void {
        $this->driver = DatabaseConnect::DRV_MYSQL;
        $this->hostname = "localhost";
        $this->port = 3306;
        $this->username = "root";
        $this->password = "";
        $this->database = "test";
    }

    /**
     * Choose driver and define the string connection
     * @return void
     */
    public function SwitchDSN(): void {
        switch ($this->driver) {
            case DatabaseConnect::DRV_CUBRID:
                $this->DSN = "$this->driver:dbname=$this->database;host=$this->hostname;port=$this->port";
                break;

            case DatabaseConnect::DRV_SQLSERVER:
                $this->DSN = "$this->driver:Server=$this->hostname;Database=$this->database";
                break;

            case DatabaseConnect::DRV_FIREBIRD:
                $this->DSN = "$this->driver:dbname=$this->hostname";
                break;

            case DatabaseConnect::DRV_MYSQL:
                $this->DSN = "$this->driver:host=$this->hostname;dbname=$this->database";
                break;

            case DatabaseConnect::DRV_ORACLE_8:
                $this->DSN = "$this->driver:dbname=$this->hostname/$this->database;charset=utf8";
                break;

            case DatabaseConnect::DRV_ODBC:
                $this->DSN = "$this->driver:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq=$this->hostname;Uid=$this->usuario";
                break;

            case DatabaseConnect::DRV_POSTGREE;
                $this->DSN = "$this->driver:host=$this->hostname;port=$this->port;dbname=$this->database;";
                break;

            case DatabaseConnect::DRV_SQLITE:
                $this->DSN = "$this->driver:$this->hostname";
                break;

            default:
                $this->DSN = NULL;
                break;
        }
    }

    /**
     * Test of connection state
     * @return bool A boolean value to represents the state connection
     */
    public function CheckConnection(): bool {
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
     * Open and define one connection based on DSN (data source name)
     * @return void
     */
    public function OpenConnection(): void {
        try {
            // Switch DSN to equivalebt suplied driver
            $this->SwitchDSN();
            // Initialize a new connection
            $this->Connection = new PDO($this->DSN, $this->username, $this->password) or die(NULL);
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
            $this->Status->Message->DefineMessage($this->Status);
        } catch (PDOException $Error) {
            // Define state of object
            $this->Status->setCode($Error->getCode());
            $this->Status->Message->ExceptionCatched($Error);
            $this->Status->GenerateLogFile();
        }
    }

    /**
     * Close  an opened connection
     */
    public function CloseConnection() {
        try {
            // Set null to connection object
            $this->Connection = NULL;
            // // Define state of object
            $this->Status->setCode("NCONN");
        } catch (PDOException $Error) {
            // Define state of object
            $this->Status->setCode($Error->getCode());
            $this->Status->Message->ExceptionCatched($Error);
            $this->Status->GenerateLogFile();
        }
    }

}
