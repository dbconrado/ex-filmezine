<?php

# script para popular com dados de filmes

# Pre-condicoes para cada linha do dataset:
# a) a linha deve ser de um "movie" de, pelo menos, 2002, senao pular.
# b) a linha nao pode ser um filme adulto
# c) a linha nao pode faltar informacoes importantes (ano e genero)
# d) a linha nao pode ser um documentario
# e) cadastrar os generos nao cadastrados

class Importer {
	protected $pdo;
	protected $generos = [];

	public function __construct() {
		$this->conectar();
	}

	public function conectar() {
		$this->pdo = new PDO("mysql:dbname=filmezine;host=localhost", "root", "");
	}

	public function inserirFilme($nome, $ano, $generos) {
		echo "Inserindo o filme: $nome ($ano) -> " . join(",", $generos) . "\n";
		$this->pdo->prepare(
			"INSERT INTO filme (
				nome,
				ano
			) VALUES (
				:nome,
				:ano
			)"
		)->execute([
			':nome' => $nome,
			':ano' => $ano
		]);
		$idFilme = $this->pdo->lastInsertId();

		$this->putGeneros($generos);
		$this->associarGeneros($idFilme, $generos);
	}

	public function associarGeneros($idFilme, $generos) {
		array_walk($generos, function($v, $i) use (&$idFilme) {
			$idGenero = array_search($v, $this->generos);

			$this->pdo->prepare(
				"INSERT INTO filme_genero (
					id_filme,
					id_genero
				) VALUES (
					:id_filme,
					:id_genero
				)"
			)->execute([
				':id_filme' => $idFilme,
				':id_genero' => $idGenero
			]);
		});
	}

	public function putGeneros($generos) {
		array_walk($generos, function($v,$i) {
			
			if (!array_search($v, $this->generos)) {
				
				$this->pdo->prepare(
					"INSERT INTO genero (
						nome
					) VALUES (
						:nome
					)"
				)->execute([
					':nome' => $v
				]);

				$this->generos[$this->pdo->lastInsertId()] = $v;

			}
		});
	}
};

$importer = new Importer();

echo "Abrindo dataset\n";

$row = 1;
$qtdeImportar = 50;

if (($handle = fopen('data.tsv', 'r')) !== FALSE) {

	while (($dados = fgetcsv($handle, 0, "\t")) !== FALSE && $row < $qtdeImportar) {

		if ($dados[1] != 'movie' ||
			$dados[4] != '0' || 
			$dados[5] < '2002' ||
			$dados[5] == '\N' ||
			$dados[8] == '\N' ||
			array_search('Documentary', explode(',',$dados[8])) !== FALSE) {

			continue;

		}

		$importer->inserirFilme($dados[2], $dados[5], explode(',',$dados[8]));

		$row++;	
	}

	fclose($handle);
	echo "\nImportação concluída.\n";
} else {
	echo "Nao consegui abrir arquivo\n";
}