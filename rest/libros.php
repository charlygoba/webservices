<?php
 
//Cargamos el framework
require_once 'index.php';


$app->get('/libros/:id', function ($id) use($db, $app) {
 			$request = $app->request;
            $select =  $db->query ("SELECT * FROM libros where id =$id");
            
 
            echo json_encode($select->fetch_assoc());
        });
 
//POST para INSERTAR
$app->post('/libros', function () use($db, $app) {
            //Request recoge variables de las peticiones http
            $request = $app->request;
 
            $insert = $db->query("INSERT INTO libros (nombre,precio) 
            	VALUES( '{$request->post("nombre")}',
            			'{$request->post("precio")}'
                                 )");
            if ($insert) {
                $result = array("status" => "true", "message" => "Libro agregado correctamente");
            } else {
                $result = array("status" => "false", "message" => "El libro NO se agregó");
            }
            echo json_encode($result);
        });
 
//PUT para ACTUALIZAR
$app->put('/libros/:id', function ($id) use($db, $app) {
 
            $request = $app->request;
 
            $sql = "UPDATE libros SET
            			nombre = '{$request->params("nombre")}',
            			precio = '{$request->params("precio")}'
            			WHERE id=$id";
 
            $update = $db->query($sql);
 
            if ($update) {
                $result = array("status" => "true", "message" => "Libro modificado correctamente");
            } else {
                $result = array("status" => "false", "message" => "Libro NO modificado");
            }
            echo json_encode($result);
        });
 
//DELETE para BORRAR
$app->delete('/libros/:id', function ($id) use($db, $app) {
 
            $request = $app->request;
 
            $sql = "DELETE FROM libros WHERE id=$id";
 
            $delete = $db->query($sql);
 
            if ($delete) {
                $result = array("status" => "true", "message" => "El libro se ha eliminado correctamente");
            } else {
                $result = array("status" => "false", "message" => "El libro NO PUDO ser eliminado");
            }
            echo json_encode($result);
        });
 
$app->run();
?>
