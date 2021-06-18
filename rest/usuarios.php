<?php
 
//Cargamos el framework
require_once 'index.php';


$app->get('/users/:id', function ($id) use($db, $app) {
 			$request = $app->request;
            $select =  $db->query ("SELECT * FROM c19_employees where person_id =$id");
            
 
            echo json_encode($select->fetch_assoc());
        });
 
//POST para INSERTAR
$app->post('/users', function () use($db, $app) {
            //Request recoge variables de las peticiones http
            $request = $app->request;
 
            $insert = $db->query("INSERT INTO usuarios (us_nombre, us_apellidop, us_apellidom, us_email, us_pw, us_tipo) VALUES( '{$request->post("us_nombre")}',
                                 '{$request->post("us_apellidop")}', 
                                 '{$request->post("us_apellidom")}', 
                                 '{$request->post("us_email")}', 
                                 '{$request->post("us_pw")}', 
                                 '{$request->post("us_tipo")}'
                                 )");
            if ($insert) {
                $result = array("status" => "true", "message" => "Usuario creado correctamente");
            } else {
                $result = array("status" => "false", "message" => "Usuario NO creado");
            }
            echo json_encode($result);
        });
 
//PUT para ACTUALIZAR
$app->put('/users/:id', function ($id) use($db, $app) {
 
            $request = $app->request;
 
            $sql = "UPDATE usuarios SET
            					 us_nombre = '{$request->params("us_nombre")}',
                                 us_apellidop = '{$request->params("us_apellidop")}', 
                                 us_apellidom = '{$request->params("us_apellidom")}', 
                                 us_email = '{$request->params("us_email")}', 
                                 us_pw = '{$request->params("us_pw")}', 
                                 us_tipo = '{$request->params("us_tipo")}'
                                 WHERE us_id=$id";
 
            $update = $db->query($sql);
 
            if ($update) {
                $result = array("status" => "true", "message" => "Usuario modificado correctamente");
            } else {
                $result = array("status" => "false", "message" => "Usuario NO modificado");
            }
            echo json_encode($result);
        });
 
//DELETE para BORRAR
$app->delete('/users/:id', function ($id) use($db, $app) {
 
            $request = $app->request;
 
            $sql = "DELETE FROM usuarios WHERE us_id=$id";
 
            $delete = $db->query($sql);
 
            if ($delete) {
                $result = array("status" => "true", "message" => "Usuario eliminado correctamente");
            } else {
                $result = array("status" => "false", "message" => "Usuario NO eliminado");
            }
            echo json_encode($result);
        });
 
$app->run();
?>
