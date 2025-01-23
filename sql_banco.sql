CREATE TABLE clientes (
    id int AUTO_INCREMENT NOT NULL,
    tipo varchar(1) NOT NULL,
    nome_social varchar(70) NOT NULL,
    email varchar(70) NOT NULL,
    nome varchar(70) NOT NULL,
    cpf varchar(30),
    razao_social varchar(70),
    cnpj varchar(30),
    PRIMARY KEY (id)
);

ALTER TABLE clientes MODIFY nome VARCHAR(70);
