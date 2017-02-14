$('.toggle').on('click', function() {
  $('.container').stop().addClass('active');
});

$('.close').on('click', function() {
  $('.container').stop().removeClass('active');
});

$('document').ready(function(){
	$("#BtnLogin").click(function(){
		var UN = $(".tb_usr").val(), 
			PW = $(".tb_pwd").val();

		if (UN == "" || PW == ""){
			if (UN == "" && PW != ""){
				$("#dialog .message").html("El campo de <b>Usuario</b> se encuentra vacío, por favor, rellene el campo para continuar.");
			} else if (UN != "" && PW == ""){
				$("#dialog .message").html("El campo de <b>Contraseña</b> se encuentra vacío, por favor, rellene el campo para continuar.");
			} else if (UN == "" && PW == "") {
				$("#dialog .message").html("Los campos se encuentran vacíos, por favor, verifíquelos y vuelva a intentarlo.");
			}
			
			$("#dialog").dialog();

			return false;
		}

		$.ajax({
			url: "source/php/login.php", 
			type: "post", 
			data: $("#FormLogin").serialize(), 
			success: function(data){
				if (data == "OK"){
					window.location.reload();
				} else if (data == "Error"){
					$("#dialog .message").html("Las credenciales son incorrectas, intente nuevamente.");
					$("#dialog").dialog();
				} else {
					$("#dialog .message").html("Up's. Lo sentimos, algo ha salido mal.");
					$("#dialog").dialog();
				}
			}
		});
		return false;
	});
});