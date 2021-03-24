<?php

class Conexion
{

    public static function conectar()
    {

        $link = new PDO("mysql:host=remotemysql.com;dbname=ZsP67MY4Ok", "ZsP67MY4Ok", "d74cm0Hfur", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND                                                                   => "SET NAMES utf8"));
        return $link;
    }
}
