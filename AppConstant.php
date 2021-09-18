<?php

/**
 * Default DateTime zone definition
 */
date_default_timezone_set("America/Sao_Paulo");

/**
 * Imformation of project
 */
define("ProjectName", "Dev-Utils");
define("Copyright", "Luis Alberto Batista Pedroso");

/**
 * Session ID
 */
define("SESSION_NAME", strtoupper(md5(ProjectName)));

/**
 * Root project
 */
define("DocRoot", $_SERVER["DOCUMENT_ROOT"]);

/**
 * Module PHP
 */
define("DocPHP", "/Dev-Utils/PHP");
define("DocRootPHP", (DocRoot . DocPHP));

/**
 * Module Multilang
 */
define("DocMultilang", "/Dev-Utils/Multilang");
define("DocRootMultilang", (DocRoot . DocMultilang));

/**
 * Module Common
 */
define("DocCommon", (DocPHP . "/Common"));
define("DocRootCommon", (DocRootPHP . "/Common"));

/**
 * Module Messages
 */
define("DocMessages", (DocMultilang . "/Messages"));
define("DocRootMessages", (DocRootMultilang . "/Messages"));

/**
 * Module Login
 */
define("DocLogin", (DocPHP . "/Personal/Login"));
define("DocRootLogin", (DocRootPHP . "/Personal/Login"));

/**
 * Module Users
 */
define("DocUsers", (DocPHP . "/Personal/Users"));
define("DocRootUsers", (DocRootPHP . "/Personal/Users"));

/**
 * Module Wallet
 */
define("DocInvestment", (DocPHP . "/Financial/Investment"));
define("DocRootInvestment", (DocRootPHP . "/Financial/Investment"));

/**
 * Test structure of the objects
 */
function TestingStructures($object = array())
{
    print("<pre>");
    print_r($object);
    print("</pre>");
}
