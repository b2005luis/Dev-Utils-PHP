<?php

/**
 * Sample to create features to operate database
 * @requires AbstractDAO
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class SampleDAO extends AbstractDAO {

    /**
     * @param Object $Record An instance of object
     * @param DatabaseConnect $Connect An instance of DatabaseConnect
     */
    public function FindRecordByID(Object $Record, DatabaseConnect $Connect) {
        // List of results
        $ListOfRecords = [];

        // Validate connection
        $Connect->CheckConnection();

        if ($Connect->Status->getCode() == "CONN") {
            try {
                $Params = $Record->GetInstanceArray();

                $this->Statement = $Connect->Connection->prepare("
                    SELECT Field1,
                           Field2,
                           Field3,
                           Field4
                    FROM Sample_Table
                    WHERE Field5 = :ID");

                $this->Statement->bindParam(":ID", $Params["ID"]);

                $Executed = $this->Statement->execute();

                if ($Executed) {
                    $this->Result = $this->Statement->fetchAll();
                    $K = count($this->Result);

                    for ($i = 0; $i < $K; $i++) {
                        $Temp = New Record();
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
                        $this->Status->Message->DefineMessage($this->Status);
                    } else {
                        // Define status
                        $this->Status->setContext("Record");
                        $this->Status->setCode("SR");
                        $this->Status->Message->DefineMessage($this->Status);
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
     *
     * @param type $Record An instance of object
     * @param DatabaseConnect $Connect An instance of DatabaseConnect
     */
    public function CreateRecord($Record, DatabaseConnect $Connect) {
        // Validate connection
        $Connect->CheckConnection();

        if ($Connect->Status->getCode() == "CONN") {
            try {
                $Params = $Record->GetInstanceArray();

                $this->Statement = $Connect->Connection->prepare("
                    INSERT INTO Table
                    VLUES (
                        :Param1,
                        :Param2,
                        :Param3,
                        :Param4
                    )");

                $this->Statement->bindParam(":Param1", $Params["Value1"]);
                $this->Statement->bindParam(":Param2", $Params["Value2"]);
                $this->Statement->bindParam(":Param3", $Params["Value3"]);
                $this->Statement->bindParam(":Param4", $Params["Value4"]);

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
                    $this->Status->GenerateLogFile();
                }
            } catch (PDOException $Error) {
                // Define status
                $this->Status->setCode($Error->getCode());
                $this->Status->Message->setContent($Error->getMessage());
                $this->Status->GenerateLogFile();
            }
        } else {
            // Define status
            $this->Status = $Connect->Status;
            $this->Status->GenerateLogFile();
        }
    }

    /**
     *
     * @param type $Record An instance of object
     * @param DatabaseConnect $Connect An instance of DatabaseConnect
     */
    public function UpdateRecord($Record, DatabaseConnect $Connect) {
        // Validate connection
        $Connect->CheckConnection();

        if ($Connect->Status->getCode() == "CONN") {
            try {
                $Params = $Record->GetInstanceArray();

                $this->Statement = $Connect->Connection->prepare("
                    UPDATE Table SET
                    Column1 = :Param1,
                    Column2 = :Param2
                    WHERE Column3 = :Param3");

                $this->Statement->bindParam(":Column1", $Params["Value1"]);
                $this->Statement->bindParam(":Column2", $Params["Value2"]);
                $this->Statement->bindParam(":Column3", $Params["Value3"]);

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
                    $this->Status->GenerateLogFile();
                }
            } catch (PDOException $Error) {
                // Define status
                $this->Status->setCode($Error->getCode());
                $this->Status->Message->setContent($Error->getMessage());
                $this->Status->GenerateLogFile();
            }
        } else {
            // Define status
            $this->Status = $Connect->Status;
            $this->Status->GenerateLogFile();
        }
    }

    /**
     *
     * @param type $Record An instance of object
     * @param DatabaseConnect $Connect An instance of DatabaseConnect
     */
    public function DeleteRecord($Record, DatabaseConnect $Connect) {
        // Validate connection
        $Connect->CheckConnection();

        if ($Connect->Status->getCode() == "CONN") {
            try {
                $Params = $Record->GetInstanceArray();

                $this->Statement = $Connect->Connection->prepare("
                    DELETE FROM Table WHERE Column1 = :Param1");

                $this->Statement->bindParam(":Param1", $Params["Value1"]);

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
                    $this->Status->GenerateLogFile();
                }
            } catch (PDOException $Error) {
                // Define status
                $this->Status->setCode($Error->getCode());
                $this->Status->Message->setContent($Error->getMessage());
                $this->Status->GenerateLogFile();
            }
        } else {
            // Define status
            $this->Status = $Connect->Status;
            $this->Status->GenerateLogFile();
        }
    }

}

class SampleActionsDAO implements IActionsDAO {

    public function Create(object $Object, \DatabaseConnect $Server) {

    }

    public function Delete(int $Id, \DatabaseConnect $Server) {

    }

    public function GetRecordByCode(object $Object, \DatabaseConnect $Server) {

    }

    public function GetRecordById(object $Object, \DatabaseConnect $Server) {

    }

    public function ListAllRecords(\DatabaseConnect $Server) {

    }

    public function ListRecordsByDescription(object $Object, \DatabaseConnect $Server) {

    }

    public function Update(object $Object, \DatabaseConnect $Server) {

    }

}
