<?php

/**
 * Responsible by manage messages of the ssystem
 * @requires DatabaseMessage
 * @requires LoginMessage
 * @requires UserMessage
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Message {

    /**
     * @var string A text with class name of CSS style to message
     */
    protected $className;

    /**
     * @return string A text with class name of CSS style to message
     */
    public function getClassName(): string {
        return $this->className;
    }

    /**
     * @param string $className One text with class name of CSS style to message
     */
    public function setClassName(string $className): void {
        $this->className = $className;
    }

    /**
     * @var string A text with class name of CSS style to icon
     */
    protected $icon;

    /**
     * @return string One text with class name of CSS style to icon
     */
    public function getIcon(): string {
        return $this->icon;
    }

    /**
     * @param string $icon A text with class name of CSS style to icon
     */
    public function setIcon(string $icon): void {
        $this->icon = $icon;
    }

    /**
     * @var string A text with title of message
     */
    protected $title;

    /**
     * @return string A text with title of message
     */
    public function getTitle(): string {
        return $this->title;
    }

    /**
     * @param string $title One text with title of message
     */
    public function setTitle(string $title): void {
        $this->title = $title;
    }

    /**
     * @var string A text with Content of message
     */
    protected $content;

    /**
     * @return string A text with Content of message
     */
    public function getContent(): string {
        return $this->content;
    }

    /**
     * @param string $content A text with Content of message
     */
    public function setContent(string $content): void {
        $this->content = $content;
    }

    /**
     * @var int A number with Timer to redirect message
     */
    protected $timer;

    /**
     * @return int A number with Timer to redirect message
     */
    function getTimer(): int {
        return $this->timer;
    }

    /**
     * @param int $timer One number with Timer to redirect message
     */
    function setTimer(int $timer): void {
        $this->timer = $timer;
    }

    /**
     * @var string An URL with path to redirect
     */
    protected $link;

    /**
     * @return string An URL with path to redirect
     */
    function getLink(): string {
        return $this->link;
    }

    /**
     * @param string $link An URL with path to redirect
     */
    function setLink(string $link): void {
        $this->link = $link;
    }

    /**
     * @var bool A boolean value with state of message
     */
    protected $enabled;

    /**
     * @return bool A boolean value with state of message
     */
    function getEnabled(): string {
        return $this->enabled;
    }

    /**
     * @param bool $enabled A boolean value with state of message
     */
    function setEnabled(string $enabled): void {
        $this->enabled = $enabled;
    }

    /**
     * Initialize sn instance od Message
     */
    public function __construct() {
        $this->setClassName("ui message");
        $this->setIcon("chat icon");
        $this->setTitle("Message");
        $this->setContent("Nothing for display here.");
        $this->setLink("");
        $this->setTimer(0);
        $this->setEnabled(true);
    }

    /**
     * Generate a message based in a message context
     * @param Status $Status Am instance of Status
     */
    public function DefineMessage(Status $Status): void {
        switch ($Status->getContext()) {
            case "Factory":
                $this->ExecuteContext($Status);
                break;

            case "Database":
                $DatabaseMSG = new DatabaseMessage();
                $DatabaseMSG->ExecuteContext($Status, $this);
                break;

            case "Users":
                $LoginMSG = new UserMessage();
                $LoginMSG->ExecuteContext($Status, $this);
                break;

            case "Login":
                $LoginMSG = new LoginMessage();
                $LoginMSG->ExecuteContext($Status, $this);
                break;

            default:
                $this->DefaultMessage($Status);
                break;
        }
    }

    /**
     * Execute an message in current contexto
     * @param Status $Status An instance of Status
     */
    private function ExecuteContext(Status $Status): void {
        /**
         * Description of states of messages
         * OK = Successfully transaction
         * FT = Fail transaction
         * SR =  No results for transation
         * FI = Indisponible feature
         * A = Wait to redirect
         * OPD = Delayed operation
         * NA = Invalid Request
         */
        switch ($Status->getCode()) {
            case "OK":
                $this->Success();
                break;

            case "FT":
                $this->Fail();
                break;

            case "SR":
                $this->NoResults();
                break;

            case "FI":
                $this->IndisponibleFunction();
                break;

            case "A":
                $this->Redirect();
                break;

            case "OPD":
                $this->DelayedOperation();
                break;

            case "NA":
                $this->InvalidRequest();
                break;

            default:
                $this->DefaultMessage($Status);
                break;
        }
    }

    /**
     * Generate the message to Success
     */
    public function Success(): void {
        $this->setClassName("ui green icon message");
        $this->setIcon("ui checkmark icon");
        $this->setTitle("Sucesso");
        $this->setContent("A transação foi concluída com sucesso");
    }

    /**
     * Generate the message to Fail
     */
    public function Fail(): void {
        $this->setClassName("ui red icon message");
        $this->setIcon("ui remove icon");
        $this->setTitle("Falha na transação");
        $this->setContent("Falha ao tentar executar a transação");
    }

    /**
     * Generate the message to Indisponible Function
     */
    public function IndisponibleFunction(): void {
        $this->setClassName("ui red icon message");
        $this->setIcon("ui triangle exclamation icon");
        $this->setTitle("Função Indisponível");
        $this->setContent("Esta função não está disponível ou ainda não foi implementada");
    }

    /**
     * Generate the message to Redirect
     */
    public function Redirect(): void {
        $this->setClassName("ui grey icon message");
        $this->setIcon("ui refresh icon");
        $this->setTitle("Aguarde...");
        $this->setContent("Caso não seja redirecionado em 10 segundos ");
    }

    /**
     * Generate the message to Delayed Operation
     */
    public function DelayedOperation(): void {
        $this->setClassName("ui orange icon message");
        $this->setIcon("ui long time icon");
        $this->setTitle("Vai demorar um pouco...");
        $this->setContent("Esta operação vai ser bem demorada, ela pode levar facilmente vários minutos");
    }

    /**
     * Generate the message to Invalid Request
     */
    public function InvalidRequest(): void {
        $this->setClassName("ui blue icon message");
        $this->setIcon("ui circle exclamation icon");
        $this->setTitle("Ação inválida");
        $this->setContent("Ação inválida ou requisição sem implementação");
    }

    /**
     * Generate the message to Default Message
     * @param Status $Status An instance of Status
     */
    public function DefaultMessage(Status $Status): void {
        $this->setClassName("ui grey icon message");
        $this->setIcon("ui chat icon");
        $this->setTitle($Status->getCode());
        $this->setContent($Status->Message->getContent());
    }

    /**
     * Generate the message to Exception Catched
     * @param Exception $Error An çinstance of Exception
     */
    public function ExceptionCatched(Exception $Error): void {
        $this->setClassName("ui red icon message");
        $this->setIcon("ui circle remove icon");
        $this->setTitle("Erro {$Error->getCode()} Capturado");
        $this->setContent($Error->getMessage());
    }

    /**
     * Generate the message to No Results
     */
    public function NoResults(): void {
        $this->setClassName("ui grey icon message");
        $this->setIcon("ui find icon");
        $this->setTitle("Sem Resultados");
        $this->setContent("Nenhum resultado para esta transação");
    }

    /**
     * Return a array with data to instance of JSON object message
     * @return array A array with data of object Message
     */
    public function GetInstanceArray(): array {
        return [
            "class" => $this->getClassName(),
            "icon" => $this->getIcon(),
            "title" => $this->getTitle(),
            "content" => $this->getContent(),
            "timer" => $this->getTimer(),
            "link" => $this->getLink(),
            "enabled" => $this->getEnabled()
        ];
    }

}
