<?php

namespace Dao\Mantenimientos;

use Dao\Table;

class Roles extends Table
{
    /*
    `roles` (
        `rolescod` varchar(128) NOT NULL,
        `rolesdsc` varchar(45) DEFAULT NULL,
        `rolesest` char(3) DEFAULT NULL,
        PRIMARY KEY (`rolescod`)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8;
    */

    public static function getAllRoles(): array
    {
        $sqlstr = "SELECT * FROM roles;";
        return self::obtenerRegistros($sqlstr, []);
    }

    public static function getRolById(string $id): array
    {
        $sqlstr = "SELECT * FROM roles WHERE rolescod = :rolescod;";
        return self::obtenerUnRegistro($sqlstr, ["rolescod" => $id]);
    }

    public static function crearRol(
        $rolescod,
        $rolesdsc,
        $rolesest
    ): int {
        $sqlstr = "INSERT INTO roles (rolescod, rolesdsc, rolesest)
                   VALUES (:rolescod, :rolesdsc, :rolesest);";

        return self::executeNonQuery($sqlstr, [
            "rolescod" => $rolescod,
            "rolesdsc" => $rolesdsc,
            "rolesest" => $rolesest
        ]);
    }

    public static function actualizarRol(
        $rolescod,
        $rolesdsc,
        $rolesest
    ): int {
        $sqlstr = "UPDATE roles SET
                        rolesdsc = :rolesdsc,
                        rolesest = :rolesest
                   WHERE rolescod = :rolescod;";

        return self::executeNonQuery($sqlstr, [
            "rolescod" => $rolescod,
            "rolesdsc" => $rolesdsc,
            "rolesest" => $rolesest
        ]);
    }

    public static function eliminarRol(string $id): int
    {
        $sqlstr = "DELETE FROM roles WHERE rolescod = :rolescod;";
        return self::executeNonQuery($sqlstr, ["rolescod" => $id]);
    }
}