<?php

class Controller{
    private $met;
    
    public function __construct($met){
        $this->met = $met;
    }
    
    public function gerenciar(){
        require_once "resources.php";
        $rm = $_SERVER["REQUEST_METHOD"];
        $clazz = "GeneralResource" . $rm;
        $resource = new $clazz();
        $nomeDoMetodo = $this->met;
        $resource->$nomeDoMetodo();
    }
}

$met = $_GET["metodo"];
$r = new Controller($met);
$r->gerenciar();

?>