/*
 * jQuery File Upload Plugin JS Example 6.7
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/*jslint nomen: true, unparam: true, regexp: true */
/*global $, window, document */

$(function() {
	'use strict';

	// Inicializa o jQuery File Upload widget
	$('#fileupload').fileupload( {
		formData : {
			c : $("#c").val(),
			id : $("#id").val()
		}
	});

	// Habilita o iframe cross-domain para opção de acesso via redirecionamento
	$('#fileupload').fileupload('option', 'redirect',
			window.location.href.replace(/\/[^\/]*$/, '/cors/result.html?%s'));

	//Adiciona o recurso e o id do registro na url para deletar um arquivo
	$('#fileupload').bind('fileuploaddestroy', function(e, data) {
		data.url += "&c=" + $("#c").val()+"&id="+$("#id").val();
	});

	// Carrega os arquivos
	$('#fileupload').each(function() {
		var that = this;
		$.getJSON(this.action, {
			c : $("#c").val(),
			id : $("#id").val()
		}, function(result) {
			if (result && result.length) {
				$(that).fileupload('option', 'done').call(that, null, {
					result : result
				});
			}
		});
	});
});


var fileNameLimitLength = function( fileName, limitLength ){
	if( fileName.length > limitLength ){
		return fileName.substring(0, limitLength)+'...';
	}
	
	return fileName;
};