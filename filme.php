<?php

require_once 'funcoes.php';
require_once 'banco.class.php';
require_once 'login.class.php';

session_start();

$banco = new Banco();
$login = new Login($banco);

if (!$login->usuarioEstaLogado()) {
	redirecionarPara('login.php');
}

if (!isset($_GET['id'])) {
	redirecionarPara('index.php');
}

$filme = $banco->selectWhere('filme', [ 'id' => $_GET['id'] ])[0];
$usuario = $login->getUsuario();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?= $filme['nome'] ?> - Filmezine</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	<header>
		<h1>Filmezine</h1>
	</header>
	<main class="bloco-central">
		
		<div id="detalhes-filme" onscroll="<?php $banco->insertInto('evidencia', ['evento' => 'scrollPage',
			'id_conteudo' => $filme['id'], 'id_usuario' => $usuario['id']]); ?>" >

			<div>
				<img src="http://placehold.it/300x400" alt="">
				<h2><?= $filme['nome'] ?> (<?= $filme['ano'] ?>)</h2>
				<h3>Sinopse</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora impedit, tempore eos fugit qui repellat magni numquam quibusdam. Porro esse vero quas laudantium, asperiores architecto consequatur ullam facilis velit laborum.</p>
				<p>Inventore, necessitatibus autem dignissimos, harum ipsa tempore totam excepturi maiores blanditiis beatae eum. Necessitatibus doloribus excepturi sit sed accusamus cum, minus aperiam ipsum eius numquam eveniet consequatur animi perferendis dolore.</p>
				<p>Eveniet, pariatur dolore ad accusamus officia eos nostrum rerum ratione odit blanditiis assumenda laborum soluta natus fugiat possimus, facere sit porro excepturi vel reiciendis aliquam quam veniam! Ad, quod, deserunt.</p>
			</div>

		</div>

	</main>
</body>
</html>