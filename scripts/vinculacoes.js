/*

Neste script, são definidas funções que devem ser vinculadas
a comportamentos do usuário na página.

*/

/*
Esta função deve ser utilizada toda vez que o usuário
clicar em um link de gênero.

O parâmetro 'elemento' é o link clicado.
*/
function viuGenero(elemento) {
	var id_usuario = elemento.dataset.usuario;
	var id_conteudo = elemento.dataset.conteudo;

	coletar(id_usuario, id_conteudo, 'viuGenero', id_sessao, function(e) {
		/* navega até o endereço do link */
		window.location = elemento.getAttribute('href');
	});
}