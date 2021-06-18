<?php
require_once "lib/nusoap.php";



$response= $client->call('ObtenerItem','1');

var_dump($response);

//Codigo para debugear y ver la respuesta y posibles errores, comentar cuando se comprueba que está correcto el servicio y la llamada
$err = $client->getError();
if ($err) {
	echo '<p><b>Constructor error: ' . $err . '</b></p>';
}
echo '<h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
echo htmlspecialchars($client->response, ENT_QUOTES) . '</b></p>';
echo '<p><b>Debug: <br>';
echo htmlspecialchars($client->debug_str, ENT_QUOTES) .'</b></p>';
//Comentar hasta aquí

if($client->fault)
{
	echo "FAULT: <p>Code: (".$client->faultcode.")</p>";
	echo "String: ".$client->faultstring;
}
else
{
    //var_dump ($response);
	echo "Codigo: ".$response['id'];
}