$(document).ready(function(){
	
	jQuery.validator.messages.required = "";
	
	$("#form2").validate({
		invalidHandler: function(e, validator) {
			var errors = validator.numberOfInvalids();
			if (errors) {
				var message = errors == 1
					? 'Você esqueceu um campo. Ele está marcado abaixo'
					: 'Você esqueceu ' + errors + ' campos.  Eles estão marcados abaixo';
				$("h2.error").html(message);
				$("h2.error").show();
			} else {
				$("h2.error").hide();
			}
		},
		onkeyup: false
	});

	//Calendário com data e hora
	$( "#dateIn, #dateOut" ).datetimepicker({dateFormat: 'dd/mm/yy'});
	
});