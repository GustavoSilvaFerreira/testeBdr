<?php

class Tarefa {
    private $id, $titulo, $descricao, $prioridade;
    
    public function __construct($id = 0, $titulo, $descricao, $prioridade) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->prioridade = $prioridade;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getTitulo() {
        return $this->titulo;
    }
    
    public function getDescricao(){
        return $this->descricao;
    }
    
    public function getPrioridade(){
        return $this->prioridade;
    }
}

?>