(function($) {
	$.fn.notificador = function(msg, time) {
		return this.each(function() {

			var obj = $(this);
		
			function setMsg()
			{
				obj.html(msg);
			}
			
			function openMsg()
			{
				obj.addClass('in');
			}
			
			function closeMsg()
			{
				obj.removeClass('in');
			}
			
			setMsg();
			openMsg();
			clearTimeout(timerOpenNotificador);
			timerOpenNotificador = setTimeout(function() {
				closeMsg();
			}, time);
		
		});
	};
})(jQuery);