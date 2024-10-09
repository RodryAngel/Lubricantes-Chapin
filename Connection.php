<?php
class Conexion{
    static public function conectar(){
        $link = new PDO("mysql:unix_socket=/cloudsql/flowing-maxim-430922-c7:us-central1:lubricanteschapin;dbname=lubricantes_db",
                        "root",
                        "admin123");

        $link->exec("set names utf8");

        return $link;
    }
}
?>

