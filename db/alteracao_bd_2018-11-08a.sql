-- alteração no banco de dados
--
-- adiciona controle de versao no banco de dados
-- e configura-o como versao 2

USE filmezine;

CREATE TABLE IF NOT EXISTS versao (
	versao INT NOT NULL
);

INSERT INTO versao VALUES (2);