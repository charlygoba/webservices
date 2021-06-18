<?php    
// incluyo nusoap 
require('lib/nusoap.php');
  
$l_oClient = new nusoap_client('http://localhost/9a/webservices/rest/server.php?wsdl', 'wsdl');
$l_oProxy  = $l_oClient->getProxy();
        
// llama al webmethod (obtenerProducto)
$parametro = isset($_GET['id'])?$_GET['id']:'';
$l_stResult = $l_oProxy->obtenerProductos($parametro);  


$cadena = ''; 
$cadena .='<?xml version="1.0" encoding="utf-8"?><productos>
        <producto>';
foreach($l_stResult as $row){
$cadena .='    <codigo>'.$row['Codigo'].'</codigo>
            <nombre>'.$row['Nombre'].'</nombre>
            <precio>'.$row['Descripcion'].'</precio>'; 
}    
$cadena .='    </producto>
            </productos>'; 
            
print($cadena);
 
 ?>