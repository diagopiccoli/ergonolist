function prepareFormConsultarPerguntas(obj)
{
	
}

function retornoFormConsultarPerguntas(obj, data)
{
	data = eval(data);
	
	$('#checklist-1').html('<ol></ol>');
	var obj1 = $('#checklist-1 > ol');
		
	$('#checklist-2').html('<ol></ol>');
	var obj2 = $('#checklist-2 > ol');
	
	console.log(data);
	
	for(var i = 0; i < data[0][1].length; i++) {
		obj1.append('<li><strong>'+data[0][1][i].pergunta+'</strong><br>'+data[0][1][i].resposta+'</li>');			
	}
	
	for(var i = 0; i < data[0][2].length; i++) {
		obj2.append('<li><strong>'+data[0][2][i].pergunta+'</strong><br>'+data[0][2][i].resposta+'</li>');			
	}
	
}

function pesquisarPerguntas()
{
	var timerEntrada;
	$('#pesquisar-perguntas').click(function(e) {		
		e.preventDefault();
		
		var obj = $(this);
		var objParent = obj.parent();
		var dataTarget = $(obj.attr('data-target'));
		
		if($('#CRI_ID').val() != null && $('#CRI_ID').val() != 'all') {
			
			$('#categoria-perguntas').html($('#CRI_ID').find('option[value="'+$('#CRI_ID').val()+'"]').html());
			
			if(!dataTarget.hasClass('in')) {
				
				objParent.addClass('active');
				dataTarget.addClass('transition-in');
				
				clearTimeout(timerEntrada);
				timerEntrada = setTimeout(function() {
					dataTarget.addClass('in');
					dataTarget.removeClass('transition-in');
				}, 500);
				
				json = [{
					type: 'POST',
					url: D_PATH+'/webroot/ajax/graficos/ajax-consultar-perguntas-checklist.php',
					data: {
						CRI_ID: $('#CRI_ID').val()
					}
				}]
				json = JSON.stringify(json);
				$(this).ajaxRequest(json, function(obj){ prepareFormConsultarPerguntas(obj); }, function(obj, data){ retornoFormConsultarPerguntas(obj, data); }, null);
				
			}
			else {
			
				objParent.removeClass('active');
				dataTarget.addClass('transition-out');
				
				clearTimeout(timerEntrada);
				timerEntrada = setTimeout(function() {
					dataTarget.removeClass('in');
					dataTarget.removeClass('transition-out');
				}, 500);
				
			}
			
		}
		else {
			$('#categoria-perguntas').html('Selecione a categoria');
			$('#CRI_ID').focus();
		}
		
	});
}

function prepareFormGerarGraficos(obj)
{
	$(obj).find('#CRI_ID').attr('disabled', true);
	$(obj).find('#CHART_TYPE').attr('disabled', true);
}

function retornoFormGerarGraficos(obj, data)
{
	$(obj).find('#CRI_ID').attr('disabled', false);
	$(obj).find('#CHART_TYPE').attr('disabled', false);
	
	console.log(data);
	data = eval(data);
	
	if(data[0].status == true) {
	
		$('#criterio-checklist').html(data[0].criterio);
		$('#definicao-checklist').html(data[0].definicao);
	
		$('#h3-url-checklist-1').html(data[1].url);
		$('#h3-url-checklist-2').html(data[2].url);
		
		gerarGrafico('div-grafico-1', data[1].a, data[1].b, data[1].c, $('#CHART_TYPE').val());
		gerarGrafico('div-grafico-2', data[2].a, data[2].b, data[2].c, $('#CHART_TYPE').val());
		
		$('#div-resultado-checklist').removeClass('close');
		
	}
	
}

function formGerarGraficos(form)
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
		$(this).ajaxRequest(json, function(obj){ prepareFormGerarGraficos(obj); }, function(obj, data){ retornoFormGerarGraficos(obj, data); }, null);
		
		return false;
	});
}

function submitOnchange()
{
	$('#CRI_ID').change(function(e) {
		e.preventDefault();
		$('#formSelecionarChecklist').submit();
	});
	
	$('#CHART_TYPE').change(function(e) {
		e.preventDefault();
		if($('#CRI_ID').val() != '') {
			$('#formSelecionarChecklist').submit();
		}
	});
}

$(document).ready(function() {
	formGerarGraficos('#formSelecionarChecklist');
	submitOnchange();
	pesquisarPerguntas();
});