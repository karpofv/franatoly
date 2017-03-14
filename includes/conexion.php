<?php

require_once '../config/conexion/db.php';

/* CREAMOS LA CONEXION CON PDO */

class Conexion extends datosConexion {

    //obtener la conexion a la base de datos MYSQL

    public function obtenerConexionMy() {
        try {
            $conectarMYSQL = new PDO("mysql:host=$this->servidorMy;dbname=$this->dbMy;", $this->usuarioMy, $this->claveMy, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            return $conectarMYSQL;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
            exit;
        }
    }

    //obtener la conexion a la base de datos POSTGRESQL
/*
    public function obtenerConexionPg() {
        try {
            $conectarPG = new PDO("pgsql:host=$this->servidorPg;dbname=$this->dbPg;", $this->usuarioPg, $this->clavePg);

            return $conectarPG;
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
            exit;
        }
    }*/

}
