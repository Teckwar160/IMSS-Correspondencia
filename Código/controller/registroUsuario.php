<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$nombre_usuario = $_POST['nombre_usuario'];
$contrasenia = $_POST['contrasenia'];
$contrasenia2 = $_POST['contrasenia2'];

// Verificar si hay una imagen subida
if (isset($_FILES['imagen_perfil']['tmp_name']) && $_FILES['imagen_perfil']['tmp_name'] != "") {
    $imagen_perfil = addslashes(file_get_contents($_FILES['imagen_perfil']['tmp_name']));
} else {
    $imagen_perfil = null; // No hay imagen subida
}

if (empty($nombre) || empty($correo) || empty($telefono) || empty($nombre_usuario) || empty($contrasenia) || empty($contrasenia2)) {
    echo 'error_1'; // Un campo está vacío
} else {
    if ($contrasenia == $contrasenia2) {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            // Incluimos la clase usuario
            require_once('../model/loginModel.php');

            // Creamos un objeto de la clase usuario
            $usuario = new LoginModel();

            // Llamamos al método para registrar el usuario
            $usuario->registroUsuario($nombre, $correo, $telefono, $nombre_usuario, $contrasenia, $imagen_perfil);
        } else {
            echo 'error_4';
        }
    } else {
        echo 'error_2';
    }
}
