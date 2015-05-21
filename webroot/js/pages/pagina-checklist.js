function prepareCriarChecklist(obj)
{
	var btn = $($(obj).attr('data-submit'));
	btn.attr('disabled', true);
	btn.html('Aguarde...');
}

function retornoCriarChecklist(obj, data)
{
	var btn = $($(obj).attr('data-submit'));
	btn.attr('disabled', false);
	btn.html(btn.attr('data-html'));
	
	data = eval(data);
	
	if(data[0].status == false) {
		$('#div-retorno-geral').notificador(data[0].msg, 5000);
	}
	else {
		eval(data[0].acao);
	}
	
}

function criarChecklist(form)
{
	$(form).submit(function(e) {
		e.preventDefault();
		
		var type = $(this).attr('method');
		var url = $(this).attr('action');
		var data = $(this).serialize();
		
		json = [{
			type: type,
			url: url,
			data: data
		}]
		json = JSON.stringify(json);
		$(this).ajaxRequest(json, function(obj){ prepareCriarChecklist(obj); }, function(obj, data){ retornoCriarChecklist(obj, data); }, null);
		
		return false;
	});
}

$(document).ready(function() {
	criarChecklist('#formCriarChecklist');	
});