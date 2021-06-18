<?php

include('lib/nusoap.php');
$server = new soap_server;
$server->configureWSDL('obtenerProductos', 'urn:obtenerProductos');  
 
$ns     = "http://localhost/9a/webservices/rest"; 
$server->configureWSDL("obtenerProductos",$ns);
$server->wsdl->schematargetnamespace=$ns;
 
 
$server->wsdl->addComplexType('RenglonProducto','complexType','struct','all','',
               array(
                        'Codigo'            => array('name' => 'Codigo', 'type' => 'xsd:string'),
                        'Nombre'            => array('name' => 'Nombre', 'type' => 'xsd:string'),
                        'Precio'       => array('name' => 'Precio', 'type' => 'xsd:decimal' ),
                        ));
                        
$server->wsdl->addComplexType('ArrayOfRenglonProducto','complexType','array','','SOAP-ENC:Array',
                                array(),
                                array(        
                                            array('ref' => 'SOAP-ENC:arrayType',
                                                  'wsdl:arrayType' => 'tns:RenglonProducto[]'                              
                                                  )                                       
                                    ),
                                'tns:RenglonProducto');                        
 
function obtenerProductos($id=false){
 $con = new mysqli("localhost","root","","apis");
$sql = "SELECT id, nombre, precio, FROM libros order by id";
$link = ConectarBase();
$rs = ConsultarBase($link,$sql);
$n=0; 
while ($row = mysql_fetch_array($rs)) {
 
    $html[$n]['Codigo']          =$row[0];
    $html[$n]['Nombre']          =$row[1];
    $html[$n]['Precio']          =$row[2];
    $n++; 
    // $rows[] = $html; 
}
 
return $html;
 
}
 
$server->xml_encoding = "utf-8";
$server->soap_defencoding = "utf-8";
$server->register('obtenerProductos',
                  array('Id_Producto' => 'xsd:int'),
                  array('return'=>'tns:ArrayOfRenglonProducto'),
                  'urn:server',
                  'urn:server#obtenerProductos',
                  
                  'rpc',
                  'literal',
                  'Este método devuelve la lista de  productos.');
                  
// Use the request to (try to) invoke the service
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);    
?>