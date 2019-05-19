<?php
/*
* 2. Refatore o código abaixo, fazendo as alterações que julgar necessário. 
*/
class QuestaoDois {
    public function estaLogado() {
        return (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) || (isset($_COOKIE['Loggedin']) && $_COOKIE['Loggedin'] == true);
    }
    
    public function index() {
        if($this->estaLogado()) {
            header("Location: http://www.google.com");
            exit();
        }
    }
}

$_SESSION['loggedin'] = true;

$QuestaoDois = new QuestaoDois();
$QuestaoDois->index();

?>