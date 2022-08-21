<?php

/**
 * Sample to create features to operate database
 * @uses AbstractDAO
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class SampleDAO extends AbstractDAO
{
    /**
     * @param Object $Record An instance of object
     * @param DatabaseConnect $Connect An instance of DatabaseConnect
     */
    public function FindRecordByID(object $Record, DatabaseConnect $Connect)
    {
        $ListOfRecords = [];

        // Validate connection
        $Connect->checkConnection();

        if ($Connect->Status->getCode() == "CONN") {
            try {
                $this->Statement = $Connect->Connection->prepare("
                    SELECT Field1,
                           Field2,
                           Field3,
                           Field4
                    FROM Sample_Table
                    WHERE Field5 = :ID");

                $this->Statement->bindValue(":ID", $Record->getField1());

                $Executed = $this->Statement->execute();

                if ($Executed) {
                    $this->Result = $this->Statement->fetchAll(PDO::FETCH_ASSOC);
                    $k = count($this->Result);

                    for ($i = 0; $i < $k; $i++) {
                        $Temp = new Record();
                        $Temp->setField1($this->Result[$i]["Field1"]);
                        $Temp->setField2($this->Result[$i]["Field2"]);
                        $Temp->setField3($this->Result[$i]["Field3"]);
                        $Temp->setField4($this->Result[$i]["Field4"]);
                        $ListOfRecords[$i] = $Temp;
                    }

                    if (count($ListOfRecords) > 0) {
                        // Define status
                        $this->Status->setContext("Record");
                        $this->Status->setCode("OK");
                        $this->Status->Message->defineMessage($this->Status);
                    } else {
                        // Define status
                        $this->Status->setContext("Record");
                        $this->Status->setCode("SR");
                        $this->Status->Message->defineMessage($this->Status);
                    }
                } else {
                    // Define status
                    $this->Status->setContext("Database");
                    $this->Status->setCode($Connect->Connection->errorCode());
                    $this->Status->Message->setContent($Connect->Connection->errorInfo());
                }
            } catch (PDOException $Error) {
                // Define status
                $this->Status->setContext("Database");
                $this->Status->setCode($Error->getCode());
                $this->Status->Message->setContent($Error->getMessage());
            }
        } else {
            // Define status
            $this->Status = $Connect->Status;
        }

        // Return resulted records
        return $ListOfRecords;
    }

    /**
     * @param type $Record An instance of object
     * @param DatabaseConnect $Connect An instance of DatabaseConnect
     */
    public function CreateRecord($Record, DatabaseConnect $Connect)
    {
        // Validate connection
        $Connect->checkConnection();

        if ($Connect->Status->getCode() == "CONN") {
            try {
                $this->Statement = $Connect->Connection->prepare("
                    INSERT INTO Sample_Table
                    VLUES (
                        :Param1,
                        :Param2,
                        :Param3,
                        :Param4
                    )");

                $this->Statement->bindValue(":Param1", $Record->getField1());
                $this->Statement->bindValue(":Param2", $Record->getField2());
                $this->Statement->bindValue(":Param3", $Record->getField3());
                $this->Statement->bindValue(":Param4", $Record->getField4());

                $Executed = $this->Statement->execute();

                if ($Executed) {
                    // Recover the Last inserted id
                    $Record->setId($Connect->Connection->lastInsertId());
                    // Define status
                    $this->Status->setCode("OK");
                } else {
                    // Define status
                    $this->Status->setCode($Connect->Connection->errorCode());
                    $this->Status->Message->setContent($Connect->Connection->errorInfo());
                    $this->Status->generateLogFile();
                }
            } catch (PDOException $Error) {
                // Define status
                $this->Status->setCode($Error->getCode());
                $this->Status->Message->setContent($Error->getMessage());
                $this->Status->generateLogFile();
            }
        } else {
            // Define status
            $this->Status = $Connect->Status;
            $this->Status->generateLogFile();
        }
    }

    /**
     *
     * @param type $Record An instance of object
     * @param DatabaseConnect $Connect An instance of DatabaseConnect
     */
    public function UpdateRecord($Record, DatabaseConnect $Connect)
    {
        // Validate connection
        $Connect->checkConnection();

        if ($Connect->Status->getCode() == "CONN") {
            try {
                $this->Statement = $Connect->Connection->prepare("
                    UPDATE Sample_Table 
                    SET Column1 = :Param1,
                        Column2 = :Param2
                    WHERE Column3 = :Param3");

                $this->Statement->bindValue(":Column1", $Record->getField1());
                $this->Statement->bindValue(":Column2", $Record->getField2());
                $this->Statement->bindValue(":Column3", $Record->getField3());

                $Executed = $this->Statement->execute();

                if ($Executed) {
                    // Number of affected rows
                    $this->Result = $this->Statement->rowCount();
                    // Define status
                    $this->Status->setCode("OK");
                } else {
                    // Define status
                    $this->Status->setCode($Connect->Connection->errorCode());
                    $this->Status->Message->setContent($Connect->Connection->errorInfo());
                    $this->Status->generateLogFile();
                }
            } catch (PDOException $Error) {
                // Define status
                $this->Status->setCode($Error->getCode());
                $this->Status->Message->setContent($Error->getMessage());
                $this->Status->generateLogFile();
            }
        } else {
            // Define status
            $this->Status = $Connect->Status;
            $this->Status->generateLogFile();
        }
    }

    /**
     *
     * @param type $Record An instance of object
     * @param DatabaseConnect $Connect An instance of DatabaseConnect
     */
    public function DeleteRecord($Record, DatabaseConnect $Connect)
    {
        // Validate connection
        $Connect->checkConnection();

        if ($Connect->Status->getCode() == "CONN") {
            try {
                $this->Statement = $Connect->Connection->prepare("
                    DELETE FROM Sample_Table WHERE Column1 = :Param1");

                $this->Statement->bindValue(":Param1", $Record->getField1());

                $Executed = $this->Statement->execute();

                if ($Executed) {
                    // Number fo affected rows
                    $this->Result = $this->Statement->rowCount();
                    // Define status
                    $this->Status->setCode("OK");
                } else {
                    // Define status
                    $this->Status->setCode($Connect->Connection->errorCode());
                    $this->Status->Message->setContent($Connect->Connection->errorInfo());
                    $this->Status->generateLogFile();
                }
            } catch (PDOException $Error) {
                // Define status
                $this->Status->setCode($Error->getCode());
                $this->Status->Message->setContent($Error->getMessage());
                $this->Status->generateLogFile();
            }
        } else {
            // Define status
            $this->Status = $Connect->Status;
            $this->Status->generateLogFile();
        }
    }
}