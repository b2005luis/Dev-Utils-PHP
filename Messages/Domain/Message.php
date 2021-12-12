<?php

/**
 * Import files
 */
require_once __DIR__ . "/DatabaseMessage.php";
require_once __DIR__ . "/LoginMessage.php";
require_once __DIR__ . "/UserMessage.php";

/**
 * Responsible by manage messages of the system
 * @uses DatabaseMessage
 * @uses LoginMessage
 * @uses UserMessage
 * @author Luis Alberto Batista Pedroso <b2005.luis@gmail.com>
 */
class Message
{
    /**
     * @var string A text with name to Context of object and your state
     */
    protected $context;

    /**
     * @var string A text with class name of CSS style to message
     */
    protected $className;

    /**
     * @var string A text with class name of CSS style to icon
     */
    protected $icon;

    /**
     * @var string A text with title of message
     */
    protected $title;

    /**
     * @var string A text with Content of message
     */
    protected $content;

    /**
     * @var int A number with Timer to redirect message
     */
    protected $timer;

    /**
     * @var bool A boolean value with state of message
     */
    protected $enabled;

    /**
     * @var string An URL with path to redirect
     */
    protected $link;

    /**
     * Initialize sn instance od Message
     */
    public function __construct()
    {
        $this->setClassName("ui message");
        $this->setIcon("chat icon");
        $this->setTitle("Message");
        $this->setContent("Nothing for display here.");
        $this->setLink("");
        $this->setTimer(0);
        $this->setEnabled(true);
    }

    /**
     * @return string A text with name to Context of object and your state
     */
    public function getContext(): string
    {
        return $this->context;
    }

    /**
     * @param string $context A text with name to Context of object and your state
     * @return void
     */
    public function setContext(string $context): void
    {
        $this->context = $context;
    }

    /**
     * @return string A text with class name of CSS style to message
     */
    public function getClassName(): string
    {
        return $this->className;
    }

    /**
     * @param string $className One text with class name of CSS style to message
     */
    public function setClassName(string $className): void
    {
        $this->className = $className;
    }

    /**
     * @return string One text with class name of CSS style to icon
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @param string $icon A text with class name of CSS style to icon
     */
    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    /**
     * @return string A text with title of message
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title One text with title of message
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string A text with Content of message
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content A text with Content of message
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return int A number with Timer to redirect message
     */
    function getTimer(): int
    {
        return $this->timer;
    }

    /**
     * @param int $timer One number with Timer to redirect message
     */
    function setTimer(int $timer): void
    {
        $this->timer = $timer;
    }

    /**
     * @return string An URL with path to redirect
     */
    function getLink(): string
    {
        return $this->link;
    }

    /**
     * @param string $link An URL with path to redirect
     */
    function setLink(string $link): void
    {
        $this->link = $link;
    }

    /**
     * @return bool A boolean value with state of message
     */
    function getEnabled(): string
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled A boolean value with state of message
     */
    function setEnabled(string $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * Generate the message to Exception Catched
     * @param Exception $Error An çinstance of Exception
     */
    public function ExceptionCatched(Exception $Error): void
    {
        $this->setClassName("ui red icon message");
        $this->setIcon("ui circle remove icon");
        $this->setTitle("Erro {$Error->getCode()} Capturado");
        $this->setContent($Error->getMessage());
    }

    /**
     * Generate a message based in a message context
     * @param Status $Status Am instance of Status
     */
    public function DefineMessage(Status $Status): void
    {
        switch ($this->getContext()) {
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
    private function ExecuteContext(Status $Status): void
    {
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
    public function Success(): void
    {
        $this->setClassName("ui green icon message");
        $this->setIcon("ui checkmark icon");
        $this->setTitle("Sucesso");
        $this->setContent("A transação foi concluída com sucesso");
    }

    /**
     * Generate the message to Fail
     */
    public function Fail(): void
    {
        $this->setClassName("ui red icon message");
        $this->setIcon("ui remove icon");
        $this->setTitle("Falha na transação");
        $this->setContent("Falha ao tentar executar a transação");
    }

    /**
     * Generate the message to No Results
     */
    public function NoResults(): void
    {
        $this->setClassName("ui grey icon message");
        $this->setIcon("ui find icon");
        $this->setTitle("Sem Resultados");
        $this->setContent("Nenhum resultado para esta transação");
    }

    /**
     * Generate the message to Indisponible Function
     */
    public function IndisponibleFunction(): void
    {
        $this->setClassName("ui red icon message");
        $this->setIcon("ui triangle exclamation icon");
        $this->setTitle("Função Indisponível");
        $this->setContent("Esta função não está disponível ou ainda não foi implementada");
    }

    /**
     * Generate the message to Redirect
     */
    public function Redirect(): void
    {
        $this->setClassName("ui grey icon message");
        $this->setIcon("ui refresh icon");
        $this->setTitle("Aguarde...");
        $this->setContent("Caso não seja redirecionado em 10 segundos ");
    }

    /**
     * Generate the message to Delayed Operation
     */
    public function DelayedOperation(): void
    {
        $this->setClassName("ui orange icon message");
        $this->setIcon("ui long time icon");
        $this->setTitle("Vai demorar um pouco...");
        $this->setContent("Esta operação vai ser bem demorada, ela pode levar facilmente vários minutos");
    }

    /**
     * Generate the message to Invalid Request
     */
    public function InvalidRequest(): void
    {
        $this->setClassName("ui blue icon message");
        $this->setIcon("ui circle exclamation icon");
        $this->setTitle("Ação inválida");
        $this->setContent("Ação inválida ou requisição sem implementação");
    }

    /**
     * Generate the message to Default Message
     * @param Status $Status An instance of Status
     */
    public function DefaultMessage(Status $Status): void
    {
        $this->setClassName("ui grey icon message");
        $this->setIcon("ui chat icon");
        $this->setTitle($Status->getCode());
        $this->setContent($Status->Message->getContent());
    }
}