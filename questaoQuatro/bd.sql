CREATE DATABASE testeBdr;
USE testeBdr;

CREATE TABLE IF NOT EXISTS user (
	cd_user INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	PRIMARY KEY (cd_user)
);

INSERT INTO `user` (name) VALUES ('Gustavo');

CREATE TABLE IF NOT EXISTS tarefas (
	cd_tarefa INT NOT NULL AUTO_INCREMENT,
	nm_titulo VARCHAR(255) NOT NULL,
	ds_tarefa TEXT NOT NULL,
	ds_prioridade INT NULL,
	PRIMARY KEY (cd_tarefa)
);