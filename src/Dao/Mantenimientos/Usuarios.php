<?php

namespace Dao\Mantenimientos;

use Dao\Table;

class Usuarios extends Table
{
    /*
    usuario
    usercod bigint(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    useremail varchar(80),
    username varchar(80),
    userpswd varchar(128),
    userfching datetime,
    userpswdest char(3),
    userpswdexp datetime,
    userest char(3),
    useractcod varchar(128),
    userpswdchg varchar(128),
    usertipo char(3) - Tipo de Usuario, Normal, Consultor o Cliente
    */

    public static function getAllUsuarios(): array
    {
        $sqlstr = "SELECT * FROM usuario;";
        return self::obtenerRegistros($sqlstr, []);
    }

    public static function getUsuarioById(int $id): array
    {
        $sqlstr = "SELECT * FROM usuario WHERE usercod = :usercod;";
        return self::obtenerUnRegistro($sqlstr, ["usercod" => $id]);
    }

    public static function crearUsuario(
        $useremail,
        $username,
        $userpswd,
        $userfching,
        $userpswdest,
        $userpswdexp,
        $userest,
        $useractcod,
        $userpswdchg,
        $usertipo
    ): int {
        $sqlstr = "INSERT INTO usuario (
                        useremail, username, userpswd, userfching,
                        userpswdest, userpswdexp, userest, useractcod,
                        userpswdchg, usertipo
                   ) VALUES (
                        :useremail, :username, :userpswd, :userfching,
                        :userpswdest, :userpswdexp, :userest, :useractcod,
                        :userpswdchg, :usertipo
                   );";

        return self::executeNonQuery($sqlstr, [
            "useremail"   => $useremail,
            "username"    => $username,
            "userpswd"    => $userpswd,
            "userfching"  => $userfching,
            "userpswdest" => $userpswdest,
            "userpswdexp" => $userpswdexp,
            "userest"     => $userest,
            "useractcod"  => $useractcod,
            "userpswdchg" => $userpswdchg,
            "usertipo"    => $usertipo
        ]);
    }

    public static function actualizarUsuario(
        $usercod,
        $useremail,
        $username,
        $userpswd,
        $userfching,
        $userpswdest,
        $userpswdexp,
        $userest,
        $useractcod,
        $userpswdchg,
        $usertipo
    ): int {
        $sqlstr = "UPDATE usuario SET
                        useremail   = :useremail,
                        username    = :username,
                        userpswd    = :userpswd,
                        userfching  = :userfching,
                        userpswdest = :userpswdest,
                        userpswdexp = :userpswdexp,
                        userest     = :userest,
                        useractcod  = :useractcod,
                        userpswdchg = :userpswdchg,
                        usertipo    = :usertipo
                   WHERE usercod = :usercod;";

        return self::executeNonQuery($sqlstr, [
            "usercod"     => $usercod,
            "useremail"   => $useremail,
            "username"    => $username,
            "userpswd"    => $userpswd,
            "userfching"  => $userfching,
            "userpswdest" => $userpswdest,
            "userpswdexp" => $userpswdexp,
            "userest"     => $userest,
            "useractcod"  => $useractcod,
            "userpswdchg" => $userpswdchg,
            "usertipo"    => $usertipo
        ]);
    }

    public static function eliminarUsuario(int $id): int
    {
        $sqlstr = "DELETE FROM usuario WHERE usercod = :usercod;";
        return self::executeNonQuery($sqlstr, ["usercod" => $id]);
    }
}