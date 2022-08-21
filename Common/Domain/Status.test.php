<?php

require_once "../../../Multilang/Messages/Domain/Message.php";
require_once "./Status.php";

$Status = new Status();
$Status->setContext("Tests");
$Status->setCode("9999");
$Status->Message->setContent("Este é um Log de testes");
$Status->generateLogFile();
