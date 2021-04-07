<?php

/**
 * Import files
 */
require_once __DIR__ . "/Message.php";

/**
 * Implements messages of Login in system
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class LoginMessage
{
    /**
     * Execute the features to LoginMessage context
     * @param Status $Status An instance of STatus
     * @param Message $message An isntance of Message
     * @return void
     */
    public function ExecuteContext(Status $Status, Message $message): void
    {
        /**
         * LOK = Succesfully login
         * FL = Fail Login
         * LB = Blocked login
         */
        switch ($Status->getCode()) {
            case "LOK":
                $this->SuccesfullyLogin();
                break;

            case "FL":
                $this->FailLogin();
                break;

            case "LB":
                $this->BlockedLogin();
                break;
        }
    }

    /**
     * @param Message $Message An isntance of Message
     * @return void
     */
    public function SuccesfullyLogin(Message $Message): void
    {
        $Message->setClassName("ui green icon message");
        $Message->setIcon("user icon");
        $Message->setTitle("Pronto...!");
        $Message->setContent("Você está conectado, aguarde... Estamos preparando tudo para você.");
    }

    /**
     * @param Message $Message An isntance of Message
     * @return void
     */
    public function FailLogin(Message $Message): void
    {
        $Message->setClassName("ui red icon message");
        $Message->setIcon("circle remove icon");
        $Message->setTitle("Falha no Login");
        $Message->setContent("Falha ao tentar autenticar o Usuário. Verifique seus dados e tente novamente.");
    }

    /**
     * @param Message $Message An isntance of Message
     * @return void
     */
    public function BlockedLogin(Message $Message): void
    {
        $Message->setClassName("ui red icon message");
        $Message->setIcon("shield icon");
        $Message->setTitle("Login Bloqueado");
        $Message->setContent("Por razões de segurança seu login foi bloqueado. Você pode tentar realizar uma recuperação de senha.");
    }
}
