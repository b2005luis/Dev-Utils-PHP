<?php

/**
 * Implements the manager of messages from Database
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class DatabaseMessage
{
    /**
     * Execute the featured of DatabaseMessage context
     * @param Status $Status An instance of Status
     * @param Message $Message An instance of Message
     * @return void
     */
    public function ExecuteContext(Status $Status, Message $Message): void
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
                $this->AccessDanied($Message);
                break;

            case "23000":
                $this->DuplicatedEntries($Message);
                break;

            case "42000":
                $this->IncorrectSintax($Message);
                break;

            case "42S22":
                $this->ColumnNotFound($Message);
                break;

            case "HY093":
                $this->ParametersNumber($Message);
                break;
        }
    }

    /**
     * @param Message $Message An instance of Message
     * @return void
     */
    private function AccessDanied(Message $Message): void
    {
        $Message->setClassName("ui red icon message");
        $Message->setIcon("shield icon");
        $Message->setTitle("Acesso Negado");
        $Message->setContent("O acesso a alguns recursos importantes foi negado. Contate o administrador do sistema");
        $Message->setEnabled(true);
    }

    /**
     * @param Message $Message An instance of Message
     * @return void
     */
    private function ColumnNotFound(Message $Message): void
    {
        $Message->setClassName("ui red icon message");
        $Message->setIcon("table icon");
        $Message->setTitle("Coluna Inexistente");
        $Message->setContent("Algumas das colunas que estão sendo usadas na transação não estão disponíveis");
    }

    /**
     * @param Message $Message An instance of Message
     * @return void
     */
    private function DuplicatedEntries(Message $Message): void
    {
        $Message->setClassName("ui red icon message");
        $Message->setIcon("ui clone icon");
        $Message->setTitle("Dados Duplicados");
        $Message->setContent("Atenção. O Sustema não permite ebtradas duplicadas. Verifique os dados e tente novamente");
    }

    /**
     * @param Message $Message An instance of Message
     * @return void
     */
    private function IncorrectSintax(Message $Message): void
    {
        $Message->setClassName("ui grey icon message");
        $Message->setIcon("code icon");
        $Message->setTitle("Sintaxe Incorreta");
        $Message->setContent("Existe algum problema no sistema. Isto pode ser por causa de uma manutenção. Tente novamente mais tarde");
    }

    /**
     * @param Message $Message An instance of Message
     * @return void
     */
    private function ParametersNumber(Message $Message): void
    {
        $Message->setClassName("ui red icon message");
        $Message->setIcon("code icon");
        $Message->setTitle("Parametros Incorretos");
        $Message->setContent("O numero de parâmetros fornecidos na transação não é suficuente ou não está correto");
    }
}
