<?php

/**
 * Implements the messages for Users in the system
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class UserMessage
{
    /**
     * Execute the featured of DatabaseMessage context
     * @param Message $Message An instance of Message
     * @param Status $Status An instance of STatus
     */
    public function ExecuteContext(Message $Message, Status $Status): void
    {
        /**
         * UOK = User creation successfully
         * UE = User already exists
         * UP = Parcial creation of the User
         */
        switch ($Status->getCode()) {
            case "UOK":
                $this->UserCreated($Message);
                break;

            case "UE":
                $this->ExistentUser($Message);
                break;

            case "UP":
                $this->ParcialCreation($Message);
                break;
        }
    }

    /**
     * @param Message $Message An instance of Message
     * @return void
     */
    public function UserCreated(Message $Message): void
    {
        $Message->setClassName("ui green icon message");
        $Message->setIcon("user icon");
        $Message->setTitle("Pronto... Cadastro Efetuado!");
        $Message->setContent("Seu cadastro foi efetuado com sucesso");
    }

    /**
     * @param Message $Message An instance of Message
     * @return void
     */
    private function ExistentUser(Message $Message): void
    {
        $Message->setClassName("ui yellow icon message");
        $Message->setIcon("user icon");
        $Message->setTitle("Usuário já cadastrado");
        $Message->setContent("Você já é cadastrado na nossa base de clentes. Tente recuperar sua senha");
    }

    /**
     * @param Message $Message An instance of Message
     * @return void
     */
    private function ParcialCreation(Message $Message): void
    {
        $Message->setClassName("ui orange icon message");
        $Message->setIcon("user icon");
        $Message->setTitle("Cadastro Parcial");
        $Message->setContent("O Cadastro foi efetuado, mas nem todos os dados foram gravados. Você pode corrigir isso editando seu Perfil");
    }
}
