<?php

/**
 * Import files
 */
require_once __DIR__ . "/Message.php";

/**
 * Implements messages of Login in system
 * @uses Message
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class LoginMessage extends Message
{
    /**
     * Initialize an instance of LoginMessage
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the features to LoginMessage context
     * @param Status $Status An instance of STatus
     * @return void
     */
    public function ExecuteContext(Status $Status): void
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
     * @return void
     */
    public function SuccesfullyLogin(): void
    {
        $this->setClassName("ui green icon message");
        $this->setIcon("user icon");
        $this->setTitle("Pronto...!");
        $this->setContent("Você está conectado, aguarde... Estamos preparando tudo para você.");
    }

    /**
     * @return void
     */
    public function FailLogin(): void
    {
        $this->setClassName("ui red icon message");
        $this->setIcon("circle remove icon");
        $this->setTitle("Falha no Login");
        $this->setContent("Falha ao tentar autenticar o Usuário. Verifique seus dados e tente novamente.");
    }

    /**
     * @return void
     */
    public function BlockedLogin(): void
    {
        $this->setClassName("ui red icon message");
        $this->setIcon("shield icon");
        $this->setTitle("Login Bloqueado");
        $this->setContent("Por razões de segurança seu login foi bloqueado. Você pode tentar realizar uma recuperação de senha.");
    }
}
