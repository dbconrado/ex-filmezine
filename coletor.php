<?php

require_once 'funcoes.php';
require_once 'banco.class.php';
require_once 'login.class.php';

session_start();

$banco = new Banco();
$login = new Login($banco);

if (!$login->usuarioEstaLogado()) {
	die(); // vou ignorar a tentativa
}

if (!isset($_POST['evento'])) {
	die();
}

$evento = $_POST['evento'];
$id_conteudo = $_POST['id_conteudo'];
$id_usuario = $_POST['id_usuario'];

$banco->insertInto('evidencia', [
	'evento' => $evento,
	'id_conteudo' => $id_conteudo,
	'id_usuario' => $id_usuario,
	'id_sessao' => $login->getIdSessao()
]);

http_response_code(200);
