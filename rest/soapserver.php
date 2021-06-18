<?php
require_once "lib/nusoap.php";
$server = new soap_server();
$server->configureWSDL('soapserver', 'urn:soapserver');

$ns="urn:http://localhost/9a/webservices/rest/soapserver.php";
$server->configureWSDL('WService de Consulta Libros ', $ns);
$server->wsdl->schemaTargetNamespace=$ns;


$server->wsdl->addComplexType(

	'Producto',
	'complexType',
	'struct',
	'all',
	'',
	array(

		'id' => array('name' => 'id', 'type' => 'xsd:int'),
		'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
		'precio' => array('name' => 'precio', 'type' => 'xsd:double')
		

	)

);

$server->wsdl->addComplexType(

	'Productos',
	'complexType',
	'array',
	'',
	'SOAP-ENC:Array',
	array(),
	array(array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Producto[]')),
	'tns:Producto'

);

$server->wsdl->addComplexType(
	'Respuesta',
	'complexType',
	'struct',
	'all',
	'', array(

		'Ok' => array('name' => 'Ok', 'type' => 'xsd:boolean')
		,'Mensaje' => array('name' => 'Mensaje', 'type' => 'xsd:string')
	));


$server->register(
	'ObtenerItem'
	,array('id' => 'xsd:int')
	,array('return' => 'tns:Producto')
	,$ns
	,$ns . '#ObtenerItem'
	,'rpc'
	,'encoded'
	,'Obtiene un Item en la base de Datos.'
);

$server->register(
	'ObtenerItems'
	,array()
	,array('return' => 'tns:Productos')
	,$ns
	,$ns . '#ObtenerItems'
	,'rpc'
	,'encoded'
	,'Obtiene una Lista Items en la base de Datos.'
);

function ObtenerItem($id) {
	$conexion = new PDO("mysql:host=localhost;dbname=apis","root" ,"");
	$query = "SELECT id,nombre,precio FROM libros WHERE Id=".$id;
	$pdolink = $conexion->prepare($query);
	$pdolink->execute();
	$producto = $pdolink->fetch(PDO::FETCH_ASSOC);
	$persona = array('id'=>'2',
		'nombre'=>'Prueb2' ,
		'precio'=>'12.5' ,
		

	);
	return new soapval('return', 'tns:Producto', $persona);
}

function ObtenerItems() {
	$conexion = new PDO("mysql:host=localhost;dbname=apis","root" ,"");
	$query = "SELECT id,nombre,precio FROM libros ";
	$pdolink = $conexion->prepare($query);
	$pdolink->execute();
	$producto = $pdolink->fetchAll(PDO::FETCH_ASSOC);
	return new soapval('return', 'tns:Productos', $productos);

}

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);
?>