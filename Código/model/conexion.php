<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DBNAME', 'correspondencia');
define('TBLNAME', 'bd');

try {
    $conexion = new mysqli(HOST, USER, PASSWORD, DBNAME);
    $conexion->set_charset('utf8');
} catch (Exception $e) {
    error_log($e->getMessage());
    exit('Error conectando a la base de datos');
}

class Conexion
{
    private $mysqli;
    private $usuario = USER;
    private $clave = PASSWORD;
    private $server = HOST;
    private $db = DBNAME;

    public function conectar()
    {
        $this->mysqli = new mysqli($this->server, $this->usuario, $this->clave, $this->db);
        if ($this->mysqli->connect_errno) {
            echo 'Fallo al conectarse con MySQL: ' . $this->mysqli->connect_error;
        }
    }

    public function query($consulta)
    {
        return $this->mysqli->query($consulta);
    }

    public function verificarRegistros($consulta)
    {
        return $this->mysqli->query($consulta)->num_rows;
    }

    public function consultaArreglo($consulta)
    {
        return $this->mysqli->query($consulta)->fetch_array();
    }
    public function consultaArregloCompleto($consulta)
    {
        $result = $this->mysqli->query($consulta);
        $data = [];
        while ($row = $result->fetch_assoc()) { // fetch_assoc para obtener cada fila como un arreglo asociativo
            $data[] = $row;
        }
        return $data; // Devuelve todos los resultados como un arreglo
    }
    public function consultaTodo($query)
    {
        $resultado = $this->mysqli->query($query); // Usa `$this->mysqli` para la conexión.
        $data = [];
        while ($row = $resultado->fetch_assoc()) { // Obtiene cada fila como un arreglo asociativo.
            $data[] = $row;
        }
        return $data; // Devuelve todos los resultados como un arreglo.
    }

    public function prepare($query)
    {
        return $this->mysqli->prepare($query);
    }

    public function cerrar()
    {
        $this->mysqli->close();
    }

    public function salvar($des)
    {
        return $this->mysqli->real_escape_string($des);
    }

    public function filtrar($string)
    {
        $res = $this->salvar($string);
        $res = mb_strtoupper($res, 'UTF-8'); // Convierte todo a mayúsculas respetando acentos
        return trim($res);
    }


    public function rescatar($string)
    {
        return $string; // No necesitas hacer ningún cambio si el almacenamiento es correcto.
    }
}
