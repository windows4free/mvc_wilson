<?php

namespace Dao\Mantenimientos;

use Dao\Table;

class Funciones extends Table
{
    /*
    funciones
    fncod varchar(255) NOT NULL PRIMARY KEY,
    fndsc varchar(255),
    fnest char(3),
    fntyp char(3)
    */

    public static function getAllFunciones(): array
    {
        $sqlstr = "SELECT * FROM funciones;";
        return self::obtenerRegistros($sqlstr, []);
    }

    public static function getFuncionById(string $id): array
    {
        $sqlstr = "SELECT * FROM funciones WHERE fncod = :fncod;";
        return self::obtenerUnRegistro($sqlstr, ["fncod" => $id]);
    }

    public static function crearFuncion(
        $fncod,
        $fndsc,
        $fnest,
        $fntyp
    ): int {
        $sqlstr = "INSERT INTO funciones (fncod, fndsc, fnest, fntyp)
                   VALUES (:fncod, :fndsc, :fnest, :fntyp);";

        return self::executeNonQuery($sqlstr, [
            "fncod" => $fncod,
            "fndsc" => $fndsc,
            "fnest" => $fnest,
            "fntyp" => $fntyp
        ]);
    }

    public static function actualizarFuncion(
        $fncod,
        $fndsc,
        $fnest,
        $fntyp
    ): int {
        $sqlstr = "UPDATE funciones SET
                        fndsc = :fndsc,
                        fnest = :fnest,
                        fntyp = :fntyp
                   WHERE fncod = :fncod;";

        return self::executeNonQuery($sqlstr, [
            "fncod" => $fncod,
            "fndsc" => $fndsc,
            "fnest" => $fnest,
            "fntyp" => $fntyp
        ]);
    }

    public static function eliminarFuncion(string $id): int
    {
        $sqlstr = "DELETE FROM funciones WHERE fncod = :fncod;";
        return self::executeNonQuery($sqlstr, ["fncod" => $id]);
    }
}