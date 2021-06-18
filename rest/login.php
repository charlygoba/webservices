<?php
 
//Cargamos el framework
require_once 'index.php';

$app->post('/login/:username', function ($username) use($db, $app) {
            $request = $app->request;
            $select =  $db->query ("SELECT username FROM c19_employees where username =".$username);
            

             if ($select) {
                $result = array("status" => "true", "message" => "Has ingresado");
            } else {
                $result = array("status" => "false", "message" => "El usuario no existe");
            }
 
            echo json_encode($result);
        });
 
$app->run();
?>
