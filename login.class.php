<?php

class Login {

	private $banco;
	private $tabela = 'usuario';

	function __construct($banco) {
		$this->banco = $banco;
	}

	function fazerLogin($login, $senha) {
		$resultado = $this->banco->selectWhere($this->tabela, [
			'login' => $login,
			'senha' => $senha
		]);

		if (!$resultado || count($resultado) == 0) {
			return false;
		} else {

			$_SESSION['usuario'] = $resultado[0];
			return true;
		}
	}

	function usuarioEstaLogado() {
		return isset($_SESSION['usuario']);
	}

	function fazerLogout() {
		if (usuarioEstaLogado()) {
			unset($_SESSION['usuario']);
		}
	}

	function getUsuario() {
		return $_SESSION['usuario'];
	}

	function getIdSessao() {
		if (!isset($_SESSION['id_sessao']))
			$_SESSION['id_sessao'] = uniqid(); // gera um identificador unico para a sessão
		
		return $_SESSION['id_sessao'];
	}
}