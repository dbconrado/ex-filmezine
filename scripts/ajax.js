function ajax(config) {

	var xhr = new XMLHttpRequest();

	xhr.addEventListener('error', config.erro);
	xhr.addEventListener('load', config.sucesso);
	xhr.addEventListener('loadend', config.fim);

	xhr.open(config.tipo, config.url);

	var form = new FormData();
	for (propriedade in config.dados) {
		form.append(propriedade, config.dados[propriedade]);
	}

	xhr.send(form);
}