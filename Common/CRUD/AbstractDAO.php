<?php

/**
 * Model of implements of attributes to database connection
 * @requires PDOStatement
 * @requires Status
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
abstract class AbstractDAO {

    /**
     * @var PDOStatement An instance of PDOStatement
     */
    protected $Statement;

    /**
     * @var string A text with the SQL statement for execution
     */
    protected $QueryString;

    /**
     * @var array A array with the feched data of queries
     */
    protected $Result;

    /**
     * @var Status An instance of Status
     */
    public $Status;

    /**
     * Initialize an instance of iCRUD
     */
    public function __construct() {
        $this->Status = new Status();
    }

}
