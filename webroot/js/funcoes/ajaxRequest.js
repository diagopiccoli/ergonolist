(function($) {
	$.fn.ajaxRequest = function(attr, beforeSend, success, error) {
		return this.each(function() {
			
			if(attr != undefined) {
			
				attr = eval(attr);
				
				var type = attr[0].type != undefined ? attr[0].type : 'POST';
				var url = attr[0].url != undefined ? attr[0].url : false;
				var async = attr[0].async != undefined ? attr[0].async : true;
				var data = attr[0].data != undefined ? attr[0].data : '';
				var obj = this;
				
				if(url != false) {
				
					$.ajax({
						type: type,
						url: url,
						async: async,
						data: data,
						beforeSend: function() {
							if(beforeSend != undefined && beforeSend != '' && beforeSend != null) {
								beforeSend(obj);
							}
						},
						success: function(data) {
							if(success != undefined && success != '' && success != null) {
								success(obj, data);
							}
						},
						error: function(e) {
							if(error != undefined && error != '' && error != null) {
								error(obj);
							}
							console.log('ERRO: Erro ao conectar-se ao arquivo');
						}
					});
					
				}
				else {
					console.log('ERRO: Url inválida.');
				}
			
			}
			else {
				console.log('ERRO: Parâmetros inválidos.');
			}
						
		});
	};
})(jQuery);