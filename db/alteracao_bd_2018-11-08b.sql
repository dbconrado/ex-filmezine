-- Alteração no banco de dados
--
-- Inclui a coluna id_sessao na tabela evidencia
-- para guardar o id da sessão do usuário.
-- O valor dessa coluna para as linhas já existentes
-- será o id do usuário.
-- Um dos objetivos é poder contabilizar a quantidade de visitas.

USE filmezine;

DELIMITER //
CREATE PROCEDURE alt_2018_11_08b ()
BEGIN
	DECLARE versao INT;
	SELECT versao
		FROM versao
		LIMIT 1
		INTO versao;
		
	IF versao != 2 THEN
		SIGNAL SQLSTATE '45001' SET MESSAGE_TEXT = 'a versao do seu banco deve ser 2.';
	ELSE
		ALTER TABLE evidencia
			ADD id_sessao VARCHAR(13);

		UPDATE evidencia
			SET id_sessao = id_usuario;

		UPDATE versao
			SET versao = 3;
	END IF;
END //
DELIMITER ;

CALL alt_2018_11_08b();
DROP PROCEDURE alt_2018_11_08b;