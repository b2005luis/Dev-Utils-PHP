<?php

/**
 * @uses PDOException
 * @uses User
 * @author Luis Alberto Batista Pedroso
 */
class PersonRepository extends AbstractDAO
{
    public function __construct()
    {
        parent::__construct();
    }

    public function findAll(DatabaseConnect $Database): array
    {
        $this->Status->setScope("PersonRepository.findAll");

        $listPersons = [];

        if ($Database->checkConnection()) {
            try {
                $this->queryString = "  SELECT Person_Id,
                                               Person_Firstname,
                                               Person_Lastname,
                                               Person_Birthday,
                                               Gender_Id,
                                               Gender_Code,
                                               Gender_Description 
                                        FROM View_Persons";

                $this->Statement = $Database->Connection->prepare($this->queryString);

                if ($this->Statement->execute()) {
                    $this->Result = $this->Statement->fetchAll(PDO::FETCH_ASSOC);
                    $k = is_array($this->Result) ? count($this->Result) : 0;

                    if ($k > 0) {
                        foreach ($this->Result as $rowSet) {
                            $person = PersonMapper::rowSetToObject($rowSet);
                            $listPersons[] = $person;
                        }
                        $this->Status->setCode("OK");
                    } else {
                        $this->Status->setCode("SR");
                    }
                } else {
                    $this->Status->setCode("FT");
                }
            } catch (PDOException $Error) {
                $this->Status->setCode($Error->getCode());
                $this->Status->Message->setContent($Error->getMessage());
                $this->Status->generateLogFile();
            }
        } else {
            $this->Status = $Database->Status;
        }

        return $listPersons;
    }

    public function findById(DatabaseConnect $Database, int $id): User
    {
        $this->Status->setScope("UserRepository.findById");

        $User = new User();

        if ($Database->checkConnection()) {
            try {
                $this->queryString = "  SELECT Person_Id,
                                               Person_Firstname,
                                               Person_Lastname,
                                               Person_Birthday,
                                               Gender_Id,
                                               Gender_Code,
                                               Gender_Description 
                                        FROM View_Persons 
                                        WHERE Person_Id = :Id";

                $this->Statement = $Database->Connection->prepare($this->queryString);
                $this->Statement->bindValue(":Id", $id);

                if ($this->Statement->execute()) {
                    $this->Result = $this->Statement->fetch(PDO::FETCH_ASSOC);

                    if ($this->Result) {
                        $User = UserMapper::rowSetToObject($this->Result);
                        $this->Status->setCode("OK");
                    } else {
                        $this->Status->setCode("SR");
                    }
                } else {
                    $this->Status->setCode($Database->Connection->errorCode());
                    $this->Status->Message->setContent($Database->Connection->errorInfo());
                }
            } catch (PDOException $Error) {
                $this->Status->setCode($Error->getCode());
                $this->Status->Message->setContext("Database");
                $this->Status->Message->setContent($Error->getMessage());
                $this->Status->generateLogFile();
            }
        } else {
            $this->Status = $Database->Status;
        }

        return $User;
    }

    public function create(DatabaseConnect $Database, User $User): User
    {
        $this->Status->setScope("UserRepository.create");

        if ($Database->checkConnection()) {
            try {
                $this->queryString = "
                    INSERT INTO Persons 
                    (
                        Firstname,
                        Lastname,
                        Birthday,
                        Gender_Id
                    ) VALUES (
                        :Firstname,
                        :Lastname,
                        :Birthday,
                        :Gender_Id
                    )";

                $this->Statement = $Database->Connection->prepare($this->queryString);
                $this->Statement->bindValue(":Firstname", $User->getFirstname());
                $this->Statement->bindValue(":Lastname", $User->getLastname());
                $this->Statement->bindValue(":Birthday", $User->Birthday->format("Y-m-d"));
                $this->Statement->bindValue(":Gender_Id", $User->Gender->getId());

                if ($this->Statement->execute()) {
                    $User->setId($Database->Connection->lastInsertId());
                    $this->Status->setCode("OK");
                } else {
                    $this->Status->setCode("FT");
                }
            } catch (PDOException $Error) {
                $this->Status->setCode($Error->getCode());
                $this->Status->Message->setContext("Database");
                $this->Status->Message->setContent($Error->getMessage());
                $this->Status->Message->defineMessage($this->Status);
                $this->Status->generateLogFile();
            }
        } else {
            $this->Status = $Database->Status;
        }

        return $User;
    }

    public function update(DatabaseConnect $Database, User $User): User
    {
        if ($Database->checkConnection()) {
            try {
                $this->queryString = "UPDATE Persons 
                                         SET Firstname = :firstname,
                                             Lastname = :lastname,
                                             Birthday = :birthday,
                                       WHERE Id = :Id";

                $this->Statement = $Database->Connection->prepare($this->queryString);
                $this->Statement->bindValue(":firstname", $User->getFirstname());
                $this->Statement->bindValue(":lastname", $User->getLastname());
                $this->Statement->bindValue(":birthday", $User->Birthday->format("Y-m-d"));
                $this->Statement->bindValue(":Id", $User->getId());

                if ($this->Statement->execute()) {
                    if ($this->Statement->rowCount() > 0) {
                        $this->Status->setCode("OK");
                    } else {
                        $this->Status->setCode("SR");
                    }
                } else {
                    $this->Status->setCode($Database->Connection->errorCode());
                    $this->Status->Message->setContent($Database->Connection->errorInfo());
                }
            } catch (PDOException $Error) {
                $this->Status->setCode($Error->getCode());
                $this->Status->Message->setContext("Database");
                $this->Status->Message->setContent($Error->getMessage());
                $this->Status->generateLogFile();
            }
        } else {
            $this->Status = $Database->Status;
        }

        return $User;
    }

    public function delete(int $id): bool
    {
        $this->Status->setScope("UserRepository.delete");

        if ($this->Connect->CheckConnection()) {
            try {
                $this->queryString = "DELETE FROM Related_Persons 
                                      WHERE Id = :User_Id";

                $this->Statement = $this->Connect->Connection->prepare($this->queryString);
                $this->Statement->bindValue(":User_Id", $id);

                if ($this->Statement->execute()) {
                    $this->Result = $this->Statement->rowCount();
                    return ($this->Result > 0);
                } else {
                    return false;
                }
            } catch (PDOException $Error) {
                $this->Status->setCode($Error->getCode());
                $this->Status->Message->setContext("Database");
                $this->Status->Message->setContent($Error->getMessage());
                $this->Status->generateLogFile();
                return false;
            }
        } else {
            $this->Status = $this->Connect->Status;
            return false;
        }
    }
}