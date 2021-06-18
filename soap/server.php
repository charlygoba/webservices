<?php
class server
{
    public function __construct()
    {

    }

    public function getLibro ($id_array)
    {
        return 'sam';
    }
}

$params = array('uri' => 'http://localhost/9a/webservices/soap/server.php');
$server = new SoapServer(NULL, $params);
$server->setClass('server');
$server->handle();

?>
