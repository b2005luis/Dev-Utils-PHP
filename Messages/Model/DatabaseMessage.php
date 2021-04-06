<?php

/**
 * Import files
 */
require_once __DIR__ . "/Message.php";

/**
 * Implements the manager of messages from Database
 * @uses Message
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class DatabaseMessage extends Message
{
    /**
     * Initialize one instance of DatabaseMessage
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the featured of DatabaseMessage context
     * @param Status $Status An instance of Status
     * @return void
     */
    public function ExecuteContext(Status $Status): void
    {
        /**
         * 1045 = Access danied to user or database
         * 23000 = Dipicated entries
         * 42000 = Incorrect Sintax
         * 42S22 = Column not found
         * HY093 = Number of parametrs
         */
        switch ($Status->getCode()) {
            case "1045":
                $this->AccessDanied();
                break;

            case "23000":
                $this->DuplicatedEntries();
                break;

            case "42000":
                $this->IncorrectSintax();
                break;

            case "42S22":
                $this->ColumnNotFound();
                break;

            case "HY093":
                $this->ParametersNumber();
                break;
        }
    }

    /**
     * @return void
     */
    private function AccessDanied(): void
    {
        $this->setClassName("ui red icon message");
        $this->setIcon("shield icon");
        $this->setTitle("Acesso Negado");
        $this->setContent("O acesso a alguns recursos importantes foi negado. Contate o administrador do sistema");
        $this->setEnabled(true);
    }

    /**
     * @return void
     */
    private function ColumnNotFound(): void
    {
        $this->setClassName("ui red icon message");
        $this->setIcon("table icon");
        $this->setTitle("Coluna Inexistente");
        $this->setContent("Algumas das colunas que estão sendo usadas na transação não estão disponíveis");
    }

    /**
     * @return void
     */
    private function DuplicatedEntries(): void
    {
        $this->setClassName("ui red icon message");
        $this->setIcon("ui clone icon");
        $this->setTitle("Dados Duplicados");
        $this->setContent("Atenção. O Sustema não permite ebtradas duplicadas. Verifique os dados e tente novamente");
    }

    /**
     * @return void
     */
    private function IncorrectSintax(): void
    {
        $this->setClassName("ui grey icon message");
        $this->setIcon("code icon");
        $this->setTitle("Sintaxe Incorreta");
        $this->setContent("Existe algum problema no sistema. Isto pode ser por causa de uma manutenção. Tente novamente mais tarde");
    }

    /**
     * @return void
     */
    private function ParametersNumber(): void
    {
        $this->setClassName("ui red icon message");
        $this->setIcon("code icon");
        $this->setTitle("Parametros Incorretos");
        $this->setContent("O numero de parâmetros fornecidos na transação não é suficuente ou não está correto");
    }
}
