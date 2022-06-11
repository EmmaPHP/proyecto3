<?php
include_once 'libs/imodel.php';
    class Model{//modelo para acceso a la bd
        function __construct(){
            $this->db = new Database();//se crea la conexion a la bd
        }
        function query($query){
            return $this->db->connect()->query($query);//simplifica los query's
        }
        function prepare($query){
            return $this->db->connect()->prepare($query);//consulta a la bd
        }
    }
?>