<?php

/**
 * Import files
 */
require_once __DIR__ . "/Message.php";

/**
 * Implements the messages for Users in the system
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class UserMessage extends Message
{
    /**
     * Initialize an instance of UserMessage
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the featured of DatabaseMessage context
     * @param Status $Status An instance of STatus
     * @param Message $Message An instance of Message
     */
    public function ExecuteContext(Status $Status): void
    {
        /**
         * UOK = User creation successfully
         * UE = User already exists
         * UP = Parcial creation of the User
         */
        switch ($Status->getCode()) {
            case "UOK":
                $this->UserCreated();
                break;

            case "UE":
                $this->ExistentUser();
                break;

            case "UP":
                $this->ParcialCreation();
                break;

            default:
                parent::ExecuteContext($Status);
                break;
        }
    }

    /**
     * @return void
     */
    public function UserCreated(): void
    {
        $this->setClassName("ui green icon message");
        $this->setIcon("user icon");
        $this->setTitle("Pronto... Cadastro Efetuado!");
        $this->setContent("Seu cadastro foi efetuado com sucesso");
    }

    /**
     * @return void
     */
    private function ExistentUser(): void
    {
        $this->setClassName("ui yellow icon message");
        $this->setIcon("user icon");
        $this->setTitle("Usuário já cadastrado");
        $this->setContent("Você já é cadastrado na nossa base de clentes. Tente recuperar sua senha");
    }

    /**
     * @return void
     */
    private function ParcialCreation(): void
    {
        $this->setClassName("ui orange icon message");
        $this->setIcon("user icon");
        $this->setTitle("Cadastro Parcial");
        $this->setContent("O Cadastro foi efetuado, mas nem todos os dados foram gravados. Você pode corrigir isso editando seu Perfil");
    }
}
