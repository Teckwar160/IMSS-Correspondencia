<?php

// Incluimos la clase conexion para poder heredar los metodos de ella.
require_once('conexion.php');


class LoginModel extends Conexion
{

  public function login($nombre_usuario, $contrasenia)
  {
    parent::conectar();
    $nombre_usuario  = parent::salvar($nombre_usuario);
    $contrasenia = parent::salvar($contrasenia);
    $consulta = 'select id_user, foto, nombre, usuario from usuarios where usuario="' . $nombre_usuario . '" and contrasenia= MD5("' . $contrasenia . '")';
    $verificar_usuario = parent::verificarRegistros($consulta);

    if ($verificar_usuario > 0) {
      $nombre_usuario = parent::consultaArreglo($consulta);
      session_start();
      $_SESSION['id_user'] = $nombre_usuario['id_user'];
      $_SESSION['nombre'] = $nombre_usuario['nombre'];
      $_SESSION['usuario'] = $nombre_usuario['usuario'];
      $_SESSION['foto'] = $nombre_usuario['foto'];
      echo 'view/index.php';
    } else {
      echo 'error_3';
    }
    parent::cerrar();
  }

  public function registroUsuario($nombre, $correo, $telefono, $nombre_usuario, $contrasenia, $imagen_perfil)
  {
    parent::conectar();

    $nombre  = parent::filtrar($nombre);
    $correo = parent::filtrar($correo);
    $telefono = parent::filtrar($telefono);
    $nombre_usuario = parent::filtrar($nombre_usuario);
    $contrasenia = parent::filtrar($contrasenia);


    // validar que el correo no exito
    $verificarCorreo = parent::verificarRegistros('select id_user from usuarios where correo="' . $correo . '" ');


    if ($verificarCorreo > 0) {
      echo 'error_3';
    } else {

      parent::query('insert into usuarios(nombre, correo, telefono, usuario, contrasenia, foto) values("' . $nombre . '", "' . $correo . '", "' . $telefono . '", "' . $nombre_usuario . '", MD5("' . $contrasenia . '"), "' . $imagen_perfil . '")');

      session_start();

      $_SESSION['usuario'] = $nombre_usuario;

      echo 'view/index.php';
    }

    parent::cerrar();
  }
}
