<?php

abstract class GeneralResource {
    
    public function __call($m, $e) {
        header('content-type: application/json');
        echo json_encode(array("response" => "Recurso inexistente $m"));
        http_response_code(404);   
    }
    
}

class GeneralResourceOPTIONS extends GeneralResource {

    public function tarefas() {
        header('allow: GET, POST, PUT, DELETE, OPTIONS');
        http_response_code(200); 
    }
    
    public function tarefa() {
        header('allow: GET, OPTIONS');
        http_response_code(200); 
    }
    
}

class GeneralResourceGET extends GeneralResource {
    
    public function tarefas() {
        header('content-type: application/json');
        require_once "model/tarefa.php";
        require_once "model/tarefaDAO.php";
        $tarefaDAO = new TarefaDAO();
        $tarefas = $tarefaDAO->getTarefas();
        
        foreach($tarefas as $tarefa) {
            $tudo[] = array("id" => $tarefa->getId(), "titulo" => $tarefa->getTitulo(), "descricao" => $tarefa->getDescricao(), "prioridade" => $tarefa->getPrioridade());
        }
        
        echo json_encode($tudo);
        http_response_code(200);
    }
    
    public function tarefa() {
        header('content-type: application/json');
        $json = file_get_contents('php://input');
        $array = json_decode($json,true);
        require_once "model/tarefa.php";
        require_once "model/tarefaDAO.php";
        $tarefaDAO = new TarefaDAO();
        $tarefa = $tarefaDAO->getTarefaByCdTarefa($_GET['arg1']);
        
        $tudo = array("id" => $tarefa->getId(), "titulo" => $tarefa->getTitulo(), "descricao" => $tarefa->getDescricao(), "prioridade" => $tarefa->getPrioridade());
        
        echo json_encode($tudo);
        http_response_code(200);
    }
    
}

class GeneralResourcePOST extends GeneralResource {
    
    public function tarefas() {
        if($_SERVER["CONTENT_TYPE"] === "application/json") {
            $json = file_get_contents('php://input');
            $array = json_decode($json,true);
            require_once "model/tarefa.php";
            require_once "model/tarefaDAO.php";
            
            $tarefa = new Tarefa(0, $array["titulo"], $array["descricao"], $array["prioridade"]);
            $tarefaDAO = new TarefaDAO();
            $cdTarefa = $tarefaDAO->inserir($tarefa);
            
            $tarefa = $tarefaDAO->getTarefaByCdTarefa($cdTarefa);
            echo json_encode(array("id" => $tarefa->getId(), "titulo" => $tarefa->getTitulo(), "descricao" => $tarefa->getDescricao(), "prioridade" => $tarefa->getPrioridade()));
            http_response_code(200);
        } else {
            echo json_encode(array("response" => "Dados inválidos"));
            http_response_code(500);   
        }
    }

}

class GeneralResourceDELETE extends GeneralResource {
    
    public function tarefas() {
        if($_SERVER["CONTENT_TYPE"] === "application/json") {
            
            require_once "model/tarefaDAO.php";
            $tarefaDAO = new TarefaDAO();
            $tarefaDAO->excluir($_GET['arg1']);
            
            echo json_encode(array("response" => "excluído"));
            http_response_code(200);
        } else {
            echo json_encode(array("response" => "Dados inválidos"));
            http_response_code(500);   
        }
    }

}

class GeneralResourcePUT extends GeneralResource {
    
    public function tarefas() {
        if($_SERVER["CONTENT_TYPE"] === "application/json") {
            $json = file_get_contents('php://input');
            $array = json_decode($json,true);
            
            require_once "model/tarefa.php";
            require_once "model/tarefaDAO.php";
            $tarefa = new Tarefa($_GET['arg1'], $array['titulo'], $array["descricao"], $array["prioridade"]);
            $tarefaDAO = new TarefaDAO();
            $cdTarefa = $tarefaDAO->alterar($tarefa);
            
            $tarefa = $tarefaDAO->getTarefaByCdTarefa($cdTarefa);
            if(!empty($tarefa->getId())) {
                echo json_encode(array("id" => $tarefa->getId(), "titulo" => $tarefa->getTitulo(), "descricao" => $tarefa->getDescricao(), "prioridade" => $tarefa->getPrioridade()));
            }
            http_response_code(200);
        } else {
            echo json_encode(array("response" => "Dados inválidos"));
            http_response_code(500);   
        }
    }
    
}
?>