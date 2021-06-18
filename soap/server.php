<?php
class server
{
    public function __construct()
    {

    }

    public function getLibro ($id)
    {
        return 'sam';
    }
}

$params = array('uri' => 'codev/soap/server.php');
$server = new SoapServer(NULL, $params);
$server->setClass('server');
$server->hanle();

?>
