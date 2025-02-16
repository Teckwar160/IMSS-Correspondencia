<?php

//Leemos las variables enviadas mediante Ajax
$nombre_usuario = $_POST['nombre_usuario_php'];
$contrasenia = $_POST['contrasenia_php'];

// Verificamos que los campos no esten vacios
if (empty($nombre_usuario) || empty($contrasenia)) {
  echo 'error_1';
} else {
  //Incluimos el modelo usuario
  require_once('../model/loginModel.php');
  $usuario = new LoginModel();
  //Llamamos al metodo login para validar los datos en la base de datos
  $usuario->login($nombre_usuario, $contrasenia);
}
