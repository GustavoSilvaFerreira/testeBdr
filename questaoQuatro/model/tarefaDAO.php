<?php

class TarefaDAO {
    private $_mysqli;
    
    public function __construct() {
        require_once "Connect.php";
        $Connect = new Connect();
        $this->_mysqli = $Connect->getConexao();
    }
    
    public function inserir(Tarefa $tarefa) {
        $stmt = $this->_mysqli->prepare("INSERT INTO tarefas(nm_titulo, ds_tarefa, ds_prioridade) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $tarefa->getTitulo(), $tarefa->getDescricao(), $tarefa->getPrioridade());
        if (!$stmt->execute()) {
            echo "Erro: (" . $stmt->errno . ") " . $stmt->error . "<br>";
        }
        
        $cd_tarefa = mysqli_insert_id($this->_mysqli);
        $stmt->close();
        
        return $cd_tarefa;
    }
    
    public function getTarefas() {
        $stmt = $this->_mysqli->query("SELECT * FROM tarefas ORDER BY ds_prioridade ASC");
        $tarefas = [];
        
        for($count = 0; $row = $stmt->fetch_assoc(); $count++) {
            $tarefas[$count] = new Tarefa($row['cd_tarefa'], $row['nm_titulo'], $row['ds_tarefa'], $row['ds_prioridade']);
        }
        
        return $tarefas;
    }
    
    public function getTarefaByCdTarefa($cdTarefa) {
        $stmt = $this->_mysqli->prepare("SELECT * FROM tarefas WHERE cd_tarefa = ? ORDER BY ds_prioridade ASC");
        $stmt->bind_param("i", $cdTarefa);
        $stmt->execute();
        $stmt->bind_result($id, $titulo, $descricao, $prioridade);
        $stmt->fetch();
        $tarefa = new Tarefa($id, $titulo, $descricao, $prioridade);
        $stmt->close();
        return $tarefa;
    }
    
    public function excluir($cdTarefa) {
        $stmt = $this->_mysqli->prepare("DELETE FROM tarefas WHERE cd_tarefa = ?");
        $stmt->bind_param("i", $cdTarefa);
        $stmt->execute();
        $stmt->close();
    }
    
    public function alterar(Tarefa $tarefa) {
        $stmt = $this->_mysqli->prepare("UPDATE tarefas SET nm_titulo = ?, ds_tarefa = ?, ds_prioridade = ? WHERE cd_tarefa = ?");
        $stmt->bind_param("sssi",$tarefa->getTitulo(), $tarefa->getDescricao(), $tarefa->getPrioridade(), $tarefa->getId());
        if (!$stmt->execute()) {
            echo "Erro: (" . $stmt->errno . ") " . $stmt->error . "<br>";
        }
        $stmt->close();
        
        return $tarefa->getId();
    }
}

?>