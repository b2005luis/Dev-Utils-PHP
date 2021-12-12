<?php

/**
 * @uses DatabaseConnect
 * @uses User
 * @uses UserMapper
 * @author Luis Alberto Batista Pedroso
 */
class UserRepository extends AbstractDAO
{
    /**
     * @var DatabaseConnect An instance of DatabaseConnect
     */
    private $Connect;

    public function __construct()
    {
        parent::__construct();
        $this->Connect = new DatabaseConnect(true);
    }

    public function findAll(): array
    {
        $this->Status->setScope("UserRepository.findAll");

        $listUsers = [];

        if ($this->Connect->CheckConnection()) {
            try {
                $this->QueryString = "  SELECT Person_Id,
                                               Person_Firstname,
                                               Person_Lastname,
                                               Person_Birthday,
                                               Gender_Id,
                                               Gender_Code,
                                               Gender_Description 
                                        FROM View_Persons";

                $this->Statement = $this->Connect->Connection->prepare($this->QueryString);

                if ($this->Statement->execute()) {
                    $this->Result = $this->Statement->fetchAll(PDO::FETCH_ASSOC);
                    $k = count($this->Result);

                    if (is_array($this->Result) && $k > 0) {
                        foreach ($this->Result as $rowSet) {
                            $user = UserMapper::rowSetToObject($rowSet);
                            $listUsers[] = $user;
                        }
                    } else {
                        $this->Status->setCode("");
                    }
                } else {
                    $this->Status->setCode("");
                }
            } catch (PDOException $Error) {
                $this->Status->setCode($Error->getCode());
                $this->Status->Message->setContent($Error->getMessage());
                $this->Status->GenerateLogFile();
            }
        } else {
            $this->Status = $this->Connect->Status;
        }

        return $listUsers;
    }

    public function findById(int $id): User
    {
        $this->Status->setScope("UserRepository.findById");

        $user = new User();

        if ($this->Connect->CheckConnection()) {
            try {
                $this->QueryString = "  SELECT Person_Id,
                                               Person_Firstname,
                                               Person_Lastname,
                                               Person_Birthday,
                                               Gender_Id,
                                               Gender_Code,
                                               Gender_Description 
                                        FROM View_Persons 
                                        WHERE Person_Id = :Id";

                $this->Statement = $this->Connect->Connection->prepare($this->QueryString);
                $this->Statement->bindValue(":Id", $id);

                if ($this->Statement->execute()) {
                    $this->Result = $this->Statement->fetch(PDO::FETCH_ASSOC);

                    if ($this->Result) {
                        $user = UserMapper::rowSetToObject($this->Result);

                        $this->Status->setCode("OK");
                    } else {
                        $this->Status->setCode("204");
                    }
                } else {
                    $this->Status->setCode($this->Connect->Connection->errorCode());
                    $this->Status->Message->setContent($this->Connect->Connection->errorInfo());
                }
            } catch (PDOException $Error) {
                $this->Status->setCode($Error->getCode());
                $this->Status->Message->setContext("Database");
                $this->Status->Message->setContent($Error->getMessage());
                $this->Status->GenerateLogFile();
            }
        } else {
            $this->Status = $this->Connect->Status;
        }

        return $user;
    }

    public function create(User $user): User
    {
        return new User();
    }

    public function update(User $user): User
    {
        return new User();
    }

    public function delete(int $id): bool
    {
        $this->Status->setScope("UserRepository.delete");

        if ($this->Connect->CheckConnection()) {
            try {
                $this->QueryString = "DELETE FROM Related_Persons 
                                      WHERE Id = :User_Id";

                $this->Statement = $this->Connect->Connection->prepare($this->QueryString);
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
                $this->Status->GenerateLogFile();
                return false;
            }
        } else {
            $this->Status = $this->Connect->Status;
            return false;
        }
    }
}