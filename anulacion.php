<?php
include 'settings.php';
$idpagoptur = $_POST['idpagotur'];
$correo = $_POST['email'];

  if($idpagoptur || $correo == null){ 
    if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
        die( header( 'location: index.php' ) );
    }
  }
 
$url = 'https://some-valid-url.xyz/listado_pasajes_det.php';
$response = wsdl($input_xml,$url);
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
    <title>Anulacion de pasajes | Pullman Tur</title>


    <!--Font Awesome-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <!--css-->
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
  </head>
  <body>
    <!--Pantalla de carga-->
    <div class="loader">
        <div></div>
    </div>
    <!--header principal de la seccion-->
    <span class="loader"><span class="loader-inner"></span></span>
    <div
      class="container col-md-12 p-5 "
      style="background-color: white; border-radius: 12px"
    >
      <h1 class="fs-4 pt-3">Anulacion de compra N° <?=$idpagoptur?> </h1>
      <nav style="--bs-breadcrumb-divider: '>'" aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#" data-bs-toggle="modal"
                  data-bs-target="#modalBanco">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Library</li>
        </ol>
      </nav>
      <h1 class="fs-4">Condiciones de anulación</h1>
      <p class="h6">
        <i class="fa-solid fa-circle-info"></i>&nbsp;La devolución se realizara
        por el 85 % del valor.
      </p>
      <p class="h6">
        <i class="fa-solid fa-circle-info"></i>&nbsp;El reembolso puede tardar
        hasta 5 dias habiles en caso de débito y un máximo de 10 días hábiles en
        caso de crédito.
      </p>
      <p class="h6">
        <i class="fa-solid fa-circle-info"></i>&nbsp;Puedes anular hasta algunas
        horas antes de la salida del servicio, para mayor información haz click
        aqui.
      </p>

      <!--Tabla con los datos de la compra y devolucion-->
      
        <div class="container table-responsive">
          <table class="table table-striped align-content-center">
            <thead>
              <tr>
                <th scope="col">Acción</th>
                <th scope="col">N° Pasaje</th>
                <th scope="col">Asiento</th>
                <th scope="col">Tramo</th>
                <th scope="col">Salida</th>
                <th scope="col">Tipo Asiento</th>
                <th scope="col">Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($response["resultado"][0]["response"] as $res_row2) {?>
              <tr>
                <td>
                  <button
                    type="button"
                    class="btn btn-danger btn-modal"
                    data-bs-toggle="modal"
                    data-bs-target="#modalBanco"
                    
                    <?php $idpasaje = $res_row2["idpasaje"]?>
                    value="<?= $idpasaje?>"                   
                    
                    
                    <?php if ($res_row2["estado"] == 'ANU'){ ?> disabled <?php   } ?>
                  
                    <?php
                    
                    $date_a = new DateTime($res_row2["fechahorasalida"]); //Carga la hora del res_row
                    $date_b = new DateTime($res_row2["fechaactual"]); //Carga la hora actual

                    $interval = date_diff($date_a,$date_b); //Calcula la diferencia con el metodo date_diff
                    $hr = $interval->format('%h'); //agarra el valor de %h

                    if($hr < 4){?>
                    disabled
                    <?php } ?>
                   
                  >
                    <i class="fa-solid fa-ban fa-sm"></i>
                  </button>
                </td>
                <?php //var_dump($res_row2); ?>
                <td><?= $res_row2["idpasaje"]?></td>
                <td><?= $res_row2["nasiento"]?></td>
                <td><?= $res_row2["origen"]?>&nbsp;&nbsp;<i class="fa-solid fa-arrow-right"></i>&nbsp;&nbsp;<?= $res_row2["destino"]?></td>

                <td><?= $res_row2["fechahorasalida"]?></td>
                <td><?= $res_row2["tipoasiento"]?></td>
                <td><i class="fa-solid fa-circle-info"></i>&nbsp;<?= $res_row2["estado"]?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        
      <!-- Modal Datos bancarios-->
      <div
        class="modal fade"
        id="modalBanco"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
        tabindex="-1"
        aria-labelledby="staticBackdropLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog">
          <div class="modal-content">
          <!--<form method="post" id="form-banco" >-->
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">
                Elige la forma de la devolución
              </h5>
              <h5 class="modal-title">Pasaje N° <label class="pasaje"></label></h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>

            </div>
            <div class="modal-body">
              <h6 class="modal-title" id="staticBackdropLabel">
                Ingrese sus datos
              </h6>
              <br />
              
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline validacion">
                      <label class="form-label" for="nombre">Nombre</label>
                      <input
                        type="text"
                        value="simon torres collao"
                        name="nombre"
                        id="nombre"
                        class="form-control"
                        pattern="[a-zA-Z'-'\s]*"
                        title="No se aceptan numeros"
                        autocomplete="nope"
                        required
                      />
                      <span id="mensaje1"></span>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline validacion">
                      <label class="form-label" for="rut">Rut</label>
                      <input
                        name="rut"
                        id="rut"
                        value="20.330.184-7"
                        type="text"
                        class="form-control"
                        onkeypress="return isNumber(event)"
                        oninput="checkRut(this)"
                        autocomplete="nope"
                        required
                      />

                      <span id="mensaje2"></span>
                    </div>
                  </div>
                </div>

                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline validacion">
                      <label class="form-label" for="form6Example1"
                        >Banco</label
                      >
                      <select
                        class="form-select"
                        aria-label="Default select example"
                        name="banco"
                        value= "1"
                        id="banco"
                        autocomplete="nope"
                        required
                      >
                        <option selected></option>
                        <option value="1">BANCO DE CHILE</option>
                        <option value="1">BANCO EDWARDS</option>
                        <option value="1">CITIBANK</option>
                        <option value="1">ATLAS</option>
                        <option value="1">CREDI CHILE</option>
                        <option value="9">BANCO INTERNACIONAL</option>
                        <option value="12">BANCO ESTADO</option>
                        <option value="14">SCOTIABANK</option>
                        <option value="16">
                          BANCO CREDITO E INVERSIONES (BCI)
                        </option>
                        <option value="16">TBANC</option>
                        <option value="16">BANCO NOVA</option>
                        <option value="27">CORPBANCA</option>
                        <option value="27">BANCO CONDELL</option>
                        <option value="28">BANCO BICE</option>
                        <option value="31">HSBC BANK</option>
                        <option value="37">BANCO SANTANDER</option>
                        <option value="39">BANCO ITAU</option>
                        <option value="49">BANCO SECURITY</option>
                        <option value="51">BANCO FALABELLA</option>
                        <option value="52">DEUTSHE BANK</option>
                        <option value="53">BANCO RIPLEY</option>
                        <option value="54">
                          RABOBANK CHILE (EX HNS BANCO)
                        </option>
                        <option value="55">BANCO CONSORCIO</option>
                        <option value="57">BANCO PENTA</option>
                        <option value="504">BANCO PARIS</option>
                        <option value="504">BBVA</option>
                        <option value="504">BANCO BBVA EXPRESS</option>
                        <option value="671">COOCRETAL</option>
                        <option value="672">COOPEUCH</option>
                      </select>
                      <span id="mensaje3"></span>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-outline validacion">
                      <label class="form-label" for="tipoCuenta"
                        >Tipo de cuenta</label
                      >
                      <select
                        class="form-select"
                        aria-label="Default select example"
                        name="tipocuenta"
                        id="tipocuenta"
                        
                        required
                      >
                        <option selected></option>
                        <option value="1c">Cta. Corriente</option>
                        <option value="2c">Cta. Vista</option>
                        <option value="3c">Cta. Ahorro</option>
                      </select>
                      <span id="mensaje4"></span>
                    </div>
                  </div>
                </div>
                <div class="row mb-4">
                  <div class="col">
                    <div class="form-outline validacion">
                      <label class="form-label" for="numcuenta"
                        >Numero de cuenta</label
                      >
                      <input
                        type="number"
                        id="numcuenta"
                        name="numcuenta"
                        value="11555466584"
                        class="form-control"
                        pattern="[0-9]+" 
                        title="Solo se permiten numeros"
                        autocomplete="nope"
                        required
                      />
                      <span id="mensaje5"></span>
                    </div>
                  </div>
                </div>
                <input type="hidden" name="idpagotur" id="pago" value="<?= $_POST['idpagotur'] ?>" />
                <input type="hidden" name="idpasaje" id="idpasaje" class="pasaje"/>
                <input type="hidden" name="correo" id="correo" value="<?= $_POST['correo'] ?>" />
                <input
                  type="submit"
                  id="button2"
                  name="ingresar"                
                  class="btn btn-primary"
                />
              <!--</form>-->
              <br />
              <br />
              <div class="container" style="font-size: 5px">
                <p class="fs-6 text-justify">
                  <i class="fa-solid fa-circle-info"></i>&nbsp;Ingrese numero de
                  cuenta Bancaria, sin puntos ni guiones y no debe tener más de
                  13 números.
                </p>
                <p class="fs-6 text-justify">
                  <i class="fa-solid fa-circle-info"></i>&nbsp;El reembolso
                  puede tardar hasta 5 dias habiles en caso de débito y un
                  máximo de 10 días hábiles en caso de crédito.
                </p>
                <p class="fs-6 text-justify">
                  <i class="fa-solid fa-circle-info"></i>&nbsp; Los pagos
                  realizados con tarjeta de Debito y Paypal se depositarán en 5
                  días hábiles, los pagos realizados con tarjeta de crédito se
                  depositarán en 10 días hábiles desde la fecha de solicitud de
                  la cancelación del boleto. en caso de dudas escríbenos a
                  ayuda@chilepasajes.cl
                </p>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-danger"
                data-bs-dismiss="modal"
              >
                Cerrar
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal Exito -->
      <div
        class="modal fade"
        id="anula-exito"
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
                ANULACIÓN EXITOSA N° <label class="numeroanu"></label>
              </h5>
            </div>
            <div class="modal-body">
              Recuerde que la devolucion sera dentro de 5 dias habiles y un
              maximo de 10 días habiles para tarjetas de credito, a partir del siguiente dia
              habil, utilice este codigo (<label class="numeroanu"></label>) para realizar cualquier consulta
              con respecto al estado de su anulación.
            </div>
            <div class="modal-footer">
              <button
                type="button"
                id="cerrar"
                class="btn btn-danger"
                data-bs-dismiss="modal"
                onclick="refreshPage()"
              >
                Cerrar
              </button>
            </div>
          </div>
        </div>
      </div>


       <!-- Modal error-->
       <div
        class="modal fade"
        id="anula-error"
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
                ERROR AL ANULAR  <label class="numeroanu"></label>
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal" 
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              Ocurrio un error inesperado, por favor vuelva a intentarlo
            </div>
            <div class="modal-footer">
              <button
                type="button"
                id="cerrar"
                class="btn btn-danger"
                data-bs-dismiss="modal"
                onclick="refreshPage()"
              >
                Cerrar
              </button>
            </div>
          </div>
        </div>
      </div>
      
      
    </div>

    <!--js-->
    <script src="js/funciones.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    $('.btn-modal').on('click', function(e) {
      	  var pasaje = $(this).val();
          //alert(pasaje);
          $('.pasaje').val(pasaje);
          $('.pasaje').html(pasaje);
    });



    $('#button2').on('click', function(e) {
      	  var pasaje = $("#idpasaje").val();
          var nombre = $("#nombre").val();
          var rut = $("#rut").val();
          var banco = $("#banco").val();
          var tipocuenta = $("#tipocuenta").val();
          var numcuenta = $("#numcuenta").val();
          var idpagotur = $("#pago").val();
          //alert(nombre + rut + pasaje + banco + tipocuenta + numcuenta + idpagotur);
          //return;
          var parametros = {
        		"idpasaje" : pasaje,
            "nombre" : nombre,
            "rut" : rut,
            "banco" : banco,
            "tipocuenta" : tipocuenta,
            "numcuenta" : numcuenta,
            "idpagotur" : idpagotur,
      	  };
          $.ajax({
            type: "POST",
            url: "anular.php",
            data: parametros,
            dataType: "json",
            success: function(res){
              var data = res.data;
              var response = res.response;

              if(data > 0) {
                $('.numeroanu').html(response);
                $("#modalBanco").modal("hide");
                $("#anula-exito").modal("show");
              }
              else if(data == 0) {
                $('.numeroanu').html("Hubo un error al tratar de anular, volver a intentar, por favor");
                $("#modalBanco").modal("hide");
                $("#anula-error").modal("show");
              }
              else {
                $('.numeroanu').html(response);
                $("#modalBanco").modal("hide");
                $("#anula-error").modal("show");
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
    <script>
    $(document).ready(function() {
      $('.validacion input').on('keyup', function() {
        let empty = false;

        $('.validacion input').each(function() {
          empty = $(this).val().length == 0;
        });

        if (empty)
          $('#button2').attr('disabled', 'disabled');
        else
          $('#button2').attr('disabled', false);
      });
    });
    </script>
  </body>
</html>
