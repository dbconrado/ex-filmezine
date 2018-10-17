/*
A função coletar() deve ser usada para registrar uma evidência
de interesse do usuário.
o parâmetro _fim pode ser uma função de callback a ser chamada
depois da realização (ou tentativa de) do registro da evidência.
*/
function coletar(idUsuario, idConteudo, evento, _fim) {

	ajax({
			tipo: 'POST',
			url: 'coletor.php',
			dados: {
				"evento": evento,
				"id_conteudo": idConteudo,
				"id_usuario": idUsuario
			},
			sucesso: function() {
				console.log("Registrou a evidência.");
			},
			erro: function() {
				console.log('ocorreu um erro');
				},
			fim: _fim
	});

}

