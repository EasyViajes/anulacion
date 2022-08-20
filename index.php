<?php
include 'settings.php';

header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <meta
      content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
      name="viewport"
    />
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Anulacion de pasajes | Pullman Tur</title>
    <!--css-->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
  </head>
  <body>
    <!--Formulario de ingreso de anulacion-->
    <div class="center formulario" id="submit-button">
      
      <h1>Anulacion de pasaje</h1>
      <!--<div id="form">-->
      <form method="post" id="form" action="anulacion_pullmantur.php">
        <div class="txt_field">
          <input type="text" id="email" name="email" onkeydown="validacionCorreo()" autocomplete="nope" required />
          <span></span>
          <label>Correo</label>
        </div>
        <div class="txt_field">
          <input type="number" name="idpagotur" id="idpagotur" onkeydown="validacionnumeros()" autocomplete="nope" required />
          <span></span>
          <label>Codigo de compra</label>
        </div>

        <!--boton que redirige a anulacion_pullmantur.html-->
        <input type="submit" name="ingresar" value="ingresar" id="button1" class="btn btn-primary" disabled />
        <br />
        <br />
        <span id="text"></span>
        <span id="text2"></span>
        <div class="space"></div>
      </form>
    <!--</div>-->

    </div>

    <!-- Modal error-->
    <div
        class="modal fade"
        id="busca-error"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">
                ERROR Al BUSCAR PASAJE
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal" 
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              EL CORREO O CODIGO DE ANULACION SON INCORRECTOS, POR FAVOR VUELVA A INTENTARLO.
            </div>
            <div class="modal-footer">
              <button
                type="button"
                id="cerrar"
                class="btn btn-danger"
                data-bs-dismiss="modal"
              >
                Cerrar
              </button>
            </div>
          </div>
        </div>


      </div>
    <script src="js/funciones.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript">

        $('#button1').on('click', function(e) {
          event.preventDefault();
      	  var email = $("#email").val();
          var idpagotur = $("#idpagotur").val();
          alert(email + idpagotur);
         
          var parametros = {
        		"email" : email,
            "idpagotur" : idpagotur,
      	  };
          $.ajax({
            type: "POST",
            url: "buscar.php",
            data: parametros,
            dataType: "json",
            success: function(res){
              var data = res.data;
              var response = res.response;

              if(data > 0) {
                $("#busca-error").modal("show");
              }
              else if(data == 0) {
                
                
              }
              else {
                
                ;
              }
		      	},
			      error : function(jqXHR, exception) {
  						var msg = '';
  						if (jqXHR.status === 0) {
  							msg = 'Not connect.\n Verify Network.';
  						} else if (jqXHR.status == 404) {
  							msg = 'Requested page not found. [404]';
  						} else if (jqXHR.status == 500) {
  							msg = 'Internal Server Error [500].';
  						} else if (exception === 'parsererror') {
  							msg = 'Requested JSON parse failed.';
  						} else if (exception === 'timeout') {
  							msg = 'Time out error.';
  						} else if (exception === 'abort') {
  							msg = 'Ajax request aborted.';
  						} else {
  							msg = 'Uncaught Error.\n' + jqXHR.responseText;
  						}
  						console.log(msg);
        		}
          });
          
    });
    </script>
  </body>
</html>
