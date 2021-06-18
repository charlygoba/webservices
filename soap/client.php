<?php
class class_implement
{
    public function __construct()
    {
        $params = array('location' => 'http://localhost/9a/webservices/soap/server.php',
                        'uri' => 'urn://localhost/9a/webservices/soap/server.php',
                        'trace' => 1);
        
        $this->instance = new SoapClient(NULL, $params);

    }

    public function getLibro($id_array)
    {
            return $this->instance->__soapCall('getNombreLibro', $id_array);
    }
    
}

$client = new client;


?>