<?php
/*
* 3. Refatore o código abaixo, fazendo as alterações que julgar necessário. 
*/
class MyUserClass {
    public function __construct() {
        require_once "questaoTresDataBaseConnection.php";
        $Connect = new QuestaoTresDataBaseConnection();
        $this->_mysqli = $Connect->getConexao();
    }
        
    public function getUserList() {
        $results = $this->_mysqli->query('SELECT name 
                                            FROM user
                                            ORDER BY name ASC')
                                  ->fetch_all();
        
        return $results;
    }
}

$MyUserClass = new MyUserClass();
print_r($MyUserClass->getUserList());

?>