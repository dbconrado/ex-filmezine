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

$usuario = $login->getUsuario();
$generos = $banco->select('genero');

$filtro = 'Todos os filmes';
if (isset($_GET['genero'])) {
	$genero = $banco->selectWhere('genero', [ 'id' => $_GET['genero'] ]);
	$genero = $genero[0];
	$filtro = "Gênero: {$genero['nome']}";

	$filmes = $banco->selectWhere('filme_por_genero', [
		'id_genero' => $_GET['genero']
	]);
} else {

	$filmes = $banco->select('filme');

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Filmezine</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>
	
	<header>
		<h1><a href="index.php" class="link_marca">Filmezine</a></h1>
	</header>

	<main id="container-filme">
		<aside>
			<h2>Gêneros</h2>
			<p> 
				Emanuelle passou por aqui. 
			</p>
			<ul class="menu generos">
				<?php foreach ($generos as $genero): ?>
				<li>
					<a href="index.php?genero=<?= $genero['id']?>"
						data-usuario="<?= $usuario['id']?>"
						data-conteudo="<?= $genero['id'] ?>"
						onclick="viuGenero(this)"> <!-- o registro da evidência começa aqui -->
						<?= $genero['nome'] ?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
		</aside>

		<article>
			<h2><?= $filtro ?></h2>
			<div id="filmes">
				<?php foreach ($filmes as $filme): ?>
				<a href="filme.php?id=<?= $filme['id'] ?>">
					<div class="filme">
						<img src="https://placehold.it/150x222" alt="<?= $filme['nome']?>">
						<h2><?= $filme['nome']?></h2>
						<p><?= $filme['ano']?></p>
					</div>
				</a>
				<?php endforeach; ?>
			</div>
		</article>

	</main>
	<script src="scripts/ajax.js"></script>
	<script src="scripts/coletor.js"></script>
	<script src="scripts/vinculacoes.js"></script>
</body>
</html>