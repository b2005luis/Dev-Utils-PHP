<?php

/**
 * Catalog with all supported drivers for PDO connectons
 * @author Luis Alberto Batista Pedroso
 */
class DatabaseDrivers
{
    /**
     * Vaalue of driver Client Cubrid
     * @var string A text with value for driver Client Cubrid
     */
    public const DRV_CUBRID = "cubrid";

    /**
     * Vaalue of driver Client SQL Server
     * @var string A text with value for driver Client SQL Server
     */
    public const DRV_SQLSERVER = "sqlsrv";

    /**
     * Vaalue of driver Client Firebird
     * @var string A text with value for driver Client Firebird
     */
    public const DRV_FIREBIRD = "firebird";

    /**
     * Vaalue of driver Client MySQL
     * @var string A text with value for driver Client MySQL
     */
    public const DRV_MYSQL = "mysql";

    /**
     * Vaalue of driver Oracle Client 8+
     * @var string A text with value for driver Oracle Client 8+
     */
    public const DRV_ORACLE_8 = "oci8";

    /**
     * Vaalue of driver Client ODBC
     * @var string A text with value for driver Client ODBC
     */
    public const DRV_ODBC = "odbc";

    /**
     * Vaalue of driver Client Postgree SQL
     * @var string A text with value for driver Client Postgree SQL
     */
    public const DRV_POSTGREE = "pgsql";

    /**
     * Vaalue of driver Client SQLite
     * @var string A text with value for driver Client SQLite
     */
    public const DRV_SQLITE = "sqlite";
}