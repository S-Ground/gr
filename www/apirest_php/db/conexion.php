<?php
include "datosConexion.php";
//Conexion a base de datos a travez de PDO 
  function Conectar($db)
  {
      try {
          //Obtenemos 
          $conexion = new PDO("mysql:host={$db['servidor']};dbname={$db['db']};charset=utf8", $db['usuario'], $db['password']);          
          $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          return $conexion;
      } catch (PDOException $e) {
          exit($e->getMessage());
      }
  }