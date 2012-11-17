$(document).ready(function(){
 	
	jQuery.validator.addMethod("password", function( value, element ) {
		var result = this.optional(element) || value.length >= 6 && /\d/.test(value) && /[a-z]/i.test(value);
		if (!result) {
			element.value = "";
			var validator = this;
			setTimeout(function() {
				validator.blockFocusCleanup = true;
				element.focus();
				validator.blockFocusCleanup = false;
			}, 1);
		}
		return result;
	}, "Sua senha deve conter no mínimo 6 caracteres, tendo um número e uma letra.");
	
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
		onkeyup: false,
		messages: {
			email: {
				required: " ",
				email: "Digite um e-mail válido, por exemplo: seunome@seuprovedor.com"
			}
		}
	});
	
});