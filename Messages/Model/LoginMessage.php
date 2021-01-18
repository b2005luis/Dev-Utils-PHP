<?php

/**
 * Implements messages of Login in system
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class LoginMessage {

    /**
     * Initialize an instance of Login Messages
     * @return LoginMessage An instance of Login Messages
     */
    public function __construct() {

    }

    /**
     * Execute the features to LoginMessage context
     * @param Status $Status An instance of STatus
     * @param Message $Message An instance of Message
     */
    public function ExecuteContext(Status $Status, Message $Message): void {
        /**
         * LOK = Succesfully login
         * FL = Fail Login
         * LB = Blocked login
         */
        switch ($Status->getCode()) {
            case "LOK":
                $this->SuccesfullyLogin($Message);
                break;

            case "FL":
                $this->FailLogin($Message);
                break;

            case "LB":
                $this->BlockedLogin($Message);
                break;
        }
    }

    /**
     * Generate the message to successfully login
     * @param Message $Message An instance of Message
     */
    public function SuccesfullyLogin(Message $Message): void {
        $Message->setClassName("ui green icon message");
        $Message->setIcon("user icon");
        $Message->setTitle("Pronto...!");
        $Message->setContent("Você está conectado, aguarde... Estamos preparando tudo para você.");
    }

    /**
     * Generate the message to failed login
     * @param Message $Message An instance of Message
     */
    public function FailLogin(Message $Message): void {
        $Message->setClassName("ui red icon message");
        $Message->setIcon("circle remove icon");
        $Message->setTitle("Falha no Login");
        $Message->setContent("Falha ao tentar autenticar o Usuário. Verifique seus dados e tente novamente.");
    }

    /**
     * Generate the message to blocked login
     * @param Message $Message An instance of Message
     */
    public function BlockedLogin(Message $Message): void {
        $Message->setClassName("ui red icon message");
        $Message->setIcon("shield icon");
        $Message->setTitle("Login Bloqueado");
        $Message->setContent("Por razões de segurança seu login foi bloqueado. Você pode tentar realizar uma recuperação de senha.");
    }

}
