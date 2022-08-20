<?php
include 'settings.php';

$idpasaje = $_POST["idpasaje"];
$_nombre = $_POST["nombre"];
$_rut = $_POST["rut"];
$_banco = $_POST["banco"];
$_tipocuenta = $_POST["tipocuenta"];
$_numcuenta = $_POST["numcuenta"];
$idpagoptur = $_POST['idpagotur'];

if ($idpagoptur != ""){
  $idpasaje = $_POST["idpasaje"];
  $_nombre = $_POST["nombre"];
  $_rut = $_POST["rut"];
  $_banco = $_POST["banco"];
  $_tipocuenta = $_POST["tipocuenta"];
  $_numcuenta = $_POST["numcuenta"];
  $idpagoptur = $_POST['idpagotur'];

    $response1 = json_decode('{"success":10007}', true);
    if(array_key_exists("success", $response1)) {
        echo json_encode(array("data"=>1,"response"=>$response1["success"]));
    }
    else if(array_key_exists("error_curl", $response1)) {
        echo json_encode(array("data"=>0,"response"=>$response1["error_curl"]));
    }
    else {
        echo json_encode(array("data"=>-1,"response"=>$response1["error"]));
    }
}else{

  echo "Error al ingresar anulacion ".$idpagoptur.  "asdasd";
  unset($_POST);

} 
    

?>
