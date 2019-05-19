# Teste Bdr

### Como rodar

* Adicione o projeto no servidor, dentro de um diretorio com nome `testeBdr`
* Crie o banco de dados com o arquivo db.sql incluso no projeto
* Configure o banco de dados nos arquivos `questaoTresDataBaseConnection.php` e `questaoQuatro/model/Connect.php`

## Para as questões 1, 2 e 3 basta acessar a raiz do projeto no navegador e clicar no arquivo

## Utilização via curl para a Questão 4

`curl -v -X OPTIONS seuhost/testeBdr/tarefas -H 'Content-Type:application/json'`

`curl -v -X GET seuhost/testeBdr/tarefas -H 'Content-Type:application/json'`

`curl -v -X POST seuhost/testeBdr/tarefas -H 'Content-Type:application/json' -d '{"titulo": "tarefa teste", "descricao": "descrição teste", "prioridade": "1"}'`

`curl -v -X PUT seuhost/testeBdr/tarefas/15 -H 'Content-Type:application/json' -d '{"titulo": "tarefa teste alterada", "descricao": "descrição teste alterada", "prioridade": "2"}'`

`curl -v -X DELETE seuhost/testeBdr/tarefas/15 -H 'Content-Type:application/json'`

## Utilização via navegador para a Questão 4

`seuhost/testeBdr/view`
