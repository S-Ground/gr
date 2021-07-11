<?php
include "db/parametros.php";
function permisos() {  
  if (isset($_SERVER['HTTP_ORIGIN'])){
      header("Access-Control-Allow-Origin: *");
      header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
      header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
      header('Access-Control-Allow-Credentials: true');      
  }  
  if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS'){
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))          
        header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: Origin, Authorization, X-Requested-With, Content-Type, Accept");
    exit(0);
  }
}
permisos();
$conexion =  Conectar($db);
//solicitud get a travez de id
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    if (isset($_GET['id'])) {      
      $sql = $conexion->prepare("SELECT * FROM datos where id=:id");
      $sql->bindValue(':id', $_GET['id']);
      $sql->execute();
      header("HTTP/1.1 200 OK");
      echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
      exit();
    }
    else{     
      //Solicitud get de todos los datos, en este caso entregamos los ultimos 20 datos 
      $sql = $conexion->prepare("SELECT * FROM ( SELECT * FROM datos ORDER BY id DESC LIMIT 25 ) sub ORDER BY id ASC");
      $sql->execute();
      $sql->setFetchMode(PDO::FETCH_ASSOC);
      header("HTTP/1.1 200 OK");
      echo json_encode( $sql->fetchAll());
      exit();
    }
} //obtencion de datos a travez de metodo post
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  if($_POST["lugar"]="home"){
    //seleccionamos el id mas alto
    $sql = $conexion->prepare("SELECT * FROM datos where id=(SELECT max(id) from datos)");
    $sql->execute();
    header("HTTP/1.1 200 OK");
    echo json_encode($sql->fetch(PDO::FETCH_ASSOC));
    exit();
  }else{
    $input = $_POST;		
    //seleccionamos todos los datos
    $sql = "INSERT INTO datos (fecha, temperatura, humedad, ph, presion, uv) VALUES (:fecha, :temperatura, :humedad, :ph, :presion, :uv)";		  
    $resultado = $conexion->prepare($sql);
    bindAllValues($resultado, $input);
    $resultado->execute();
    $id = $conexion->lastInsertId();
    if($id){
      $input['id'] = $id;
      header("HTTP/1.1 200 OK");
      echo json_encode($input);
      exit();
    }
  }
}
//metodo put, nos permite actualizar datos
if ($_SERVER['REQUEST_METHOD'] == 'PUT'){
    $input = $_GET;	
    $id = $input['id'];
    $campos = getParams($input);
    $sql = "UPDATE datos SET $campos WHERE id='$id'";
    $resultado = $conexion->prepare($sql);
    bindAllValues($resultado, $input);
    $resultado->execute();
    header("HTTP/1.1 200 OK");
    exit();
}
//metodo delete, nos permite eliminar elementos en la tabla datos
if ($_SERVER['REQUEST_METHOD'] == 'DELETE'){
  $id = $_GET['id'];
  $resultado = $conexion->prepare("DELETE FROM datos where id=:id");
  $resultado->bindValue(':id', $id);
  $resultado->execute();
  header("HTTP/1.1 200 OK");
  exit();
}
header("HTTP/1.1 400 Peticion HTTP inexistente");
