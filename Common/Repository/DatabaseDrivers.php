<?php

/**
 * Catalog with all supported drivers for PDO connectons
 * @author Luis Alberto Batista Pedroso
 */
abstract class DatabaseDrivers
{
    /**
     * Vaalue of driver Client Cubrid
     * @var string A text with value for driver Client Cubrid
     */
    const DRV_CUBRID = "cubrid";

    /**
     * Vaalue of driver Client SQL Server
     * @var string A text with value for driver Client SQL Server
     */
    const DRV_SQLSERVER = "sqlsrv";

    /**
     * Vaalue of driver Client Firebird
     * @var string A text with value for driver Client Firebird
     */
    const DRV_FIREBIRD = "firebird";

    /**
     * Vaalue of driver Client MySQL
     * @var string A text with value for driver Client MySQL
     */
    const DRV_MYSQL = "mysql";

    /**
     * Vaalue of driver Oracle Client 8+
     * @var string A text with value for driver Oracle Client 8+
     */
    const DRV_ORACLE_8 = "oci8";

    /**
     * Vaalue of driver Client ODBC
     * @var string A text with value for driver Client ODBC
     */
    const DRV_ODBC = "odbc";

    /**
     * Vaalue of driver Client Postgree SQL
     * @var string A text with value for driver Client Postgree SQL
     */
    const DRV_POSTGREE = "pgsql";

    /**
     * Vaalue of driver Client SQLite
     * @var string A text with value for driver Client SQLite
     */
    const DRV_SQLITE = "sqlite";
}