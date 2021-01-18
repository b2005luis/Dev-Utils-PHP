<?php

/**
 * Implements a path manager for files in the prject
 * @author Luis Albert Batista Pedroso <b2005.luis@gmail.com>
 */
class Router {

    /**
     * Absolute Path of public folder in web server
     * @var string A text wuth absolute path of public folder in web server
     */
    protected $docRoot;

    /**
     * Relative path of project folder in web server
     * @var string A text with relative path of project folder in web server
     */
    protected $docProject;

    /**
     * Absolute path of project folder in web server
     * @var string A text with absolute path of project folder in web server
     */
    protected $docRootProject;

    /**
     * Initialize an instance of Router
     * @return Router An instance of Router
     */
    public function __construct($DirName = "/") {
        // Get the absolute path of server
        $this->docRoot = $_SERVER["DOCUMENT_ROOT"];
        // Define the relative path of project
        $this->docProject = "/$DirName";
        // Define the absolute path of project
        $this->docRootProject = join("/", [$this->docRoot, $this->docProject]);
    }

    /**
     * Gera e retorna um caminho relativo para um local.
     * @return string Um conjunto de caracteres com caminho relativo para um local.
     */
    public function GetLink($modulo, $complemento) {
        return join("/", [$this->docProject, $modulo, $complemento]);
    }

    /**
     * Gera e retorna um caminho absoluto para um módulo.
     * @return string Um conjunto de caracteres com caminho absoluto para um módulo.
     */
    public function GetModule($modulo, $complemento) {
        return join("/", [$this->docRootProject, $modulo, $complemento]);
    }

}
