<?php

class QuestaoUm {
    private $_numeroInicial, $_numeroFinal;
    
    public function __construct($numeroInicial = 1, $numeroFinal = 100){
        $this->_numeroInicial = $numeroInicial;
        $this->_numeroFinal = $numeroFinal;
    }
    
    public function imprimeNumero($numero) {
        echo ($numero % 3 == 0 ? ($numero % 5 == 0 ? 'FizzBuzz' : 'Fizz') : ($numero % 5 == 0 ? 'Buzz' : $numero)) . ' ';
    }
    
    public function imprimeNumeros() {
        for($i = $this->_numeroInicial; $i <= $this->_numeroFinal; $i++) {
            echo $this->imprimeNumero($i);
        }
    }
}

$QuestaoUm = new QuestaoUm();
$QuestaoUm->imprimeNumeros();

?>