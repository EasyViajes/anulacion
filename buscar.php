<?php
include 'settings.php';

$idpagoptur = $_POST['idpagotur'];
$correo = $_POST['email'];

$url = 'https://some-valid-url.xyz/listado_pasajes_det.php';

$response = wsdl($input_xml,$url);

if(array_key_exists("resultado", $response)) {
    echo json_encode(array("data"=>1,"response"=>$response["resultado"]));
}
else if(array_key_exists("error_curl", $response)) {
    echo json_encode(array("data"=>0,"response"=>$response["error_curl"]));
}
else {
    echo json_encode(array("data"=>-1,"response"=>$response["error"]));
}


?>
