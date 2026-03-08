<?php

namespace Controllers\Mantenimientos\Funciones;

use Dao\Mantenimientos\Funciones as FuncionesDAO;
use Controllers\PublicController;
use Views\Renderer;
use Utilities\Site;

const FUNCIONES_FORMULARIO_URL = "index.php?page=Mantenimientos-Funciones-Formulario";
const FUNCIONES_LISTADO_URL = "index.php?page=Mantenimientos-Funciones-Listado";
const FUNCIONES_XSRF_KEY = "Mantenimientos_Funciones_Formulario";

class Formulario extends PublicController
{
    private array $viewData = [];
    private array $modes = [
        "INS" => "Nueva Función",
        "UPD" => "Actualizar %s %s",
        "DSP" => "Detalle de %s %s",
        "DEL" => "Eliminando %s %s"
    ];
    private array $confirmTooltips = [
        "INS" => "",
        "UPD" => "",
        "DSP" => "",
        "DEL" => "¿Esta Seguro de Realizar la Eliminación? ¡¡Esto no se puede Revertir!!"
    ];

    private $fncod;
    private $fndsc;
    private $fnest;
    private $fntyp;

    private $xsrfToken = '';
    private $mode;

    public function run(): void
    {
        $this->LoadPage();
        if ($this->isPostBack()) {
            $this->CapturarDatos();
            if ($this->ValidarDatos()) {
                switch ($this->mode) {
                    case "INS":
                        if (FuncionesDAO::crearFuncion(
                            $this->fncod,
                            $this->fndsc,
                            $this->fnest,
                            $this->fntyp
                        ) !== 0) {
                            Site::redirectToWithMsg(FUNCIONES_LISTADO_URL, "Función creada satisfactoriamente");
                        };
                    case "UPD":
                        if (FuncionesDAO::actualizarFuncion(
                            $this->fncod,
                            $this->fndsc,
                            $this->fnest,
                            $this->fntyp
                        ) !== 0) {
                            Site::redirectToWithMsg(FUNCIONES_LISTADO_URL, "Función actualizada satisfactoriamente");
                        };
                    case "DEL":
                        if (FuncionesDAO::eliminarFuncion(
                            $this->fncod
                        ) !== 0) {
                            Site::redirectToWithMsg(FUNCIONES_LISTADO_URL, "Función eliminada satisfactoriamente");
                        };
                }
            }
        }
        $this->GenerarViewData();
        Renderer::render("mantenimientos/funciones/formulario", $this->viewData);
    }

    private function LoadPage()
    {
        $this->mode = $_GET["mode"] ?? '';
        if (!isset($this->modes[$this->mode])) {
            Site::redirectToWithMsg(FUNCIONES_LISTADO_URL, "Error al cargar formulario, Intente de nuevo");
        }
        $this->fncod = $_GET["id"] ?? '';
        if ($this->mode !== "INS" && empty($this->fncod)) {
            Site::redirectToWithMsg(FUNCIONES_LISTADO_URL, "Error al cargar formulario, Se requiere Id de la Función");
        } else {
            if ($this->mode !== "INS") {
                $this->CargarDatos();
            }
        }
    }

    private function CargarDatos()
    {
        $tmpFuncion = FuncionesDAO::getFuncionById($this->fncod);
        if (count($tmpFuncion) <= 0) {
            Site::redirectToWithMsg(FUNCIONES_LISTADO_URL, "No se encontró la Función");
        }
        $this->fndsc = $tmpFuncion["fndsc"];
        $this->fnest = $tmpFuncion["fnest"];
        $this->fntyp = $tmpFuncion["fntyp"];
    }

    private function CapturarDatos()
    {
        $this->fncod     = $_POST["fncod"] ?? '';
        $this->fndsc     = $_POST["fndsc"] ?? '';
        $this->fnest     = $_POST["fnest"] ?? '';
        $this->fntyp     = $_POST["fntyp"] ?? '';
        $this->xsrfToken = $_POST["uuid"] ?? '';
    }

    private function ValidarDatos()
    {
        $sessionToken = $_SESSION[FUNCIONES_XSRF_KEY] ?? '';
        if ($this->xsrfToken !== $sessionToken) {
            Site::redirectToWithMsg(FUNCIONES_LISTADO_URL, "Error al cargar formulario, Inconsistencia en la Petición");
        }
        $validateId = $_GET["id"] ?? '';
        if ($validateId !== $this->fncod) {
            return false;
        }
        return true;
    }

    private function GenerarViewData()
    {
        $this->viewData["mode"]        = $this->mode;
        $this->viewData["modeDsc"]     = sprintf($this->modes[$this->mode], $this->fncod, $this->fndsc);
        $this->viewData["id"]          = $this->fncod;
        $this->viewData["fncod"]       = $this->fncod;
        $this->viewData["fndsc"]       = $this->fndsc;
        $this->viewData["fnest"]       = $this->fnest;
        $this->viewData["fntyp"]       = $this->fntyp;
        $this->viewData["isReadonly"]  = ($this->mode === 'DEL' || $this->mode === 'DSP') ? 'readonly' : '';
        $this->viewData["hideConfirm"] = $this->mode === 'DSP';
        $this->viewData["confirmToolTip"] = $this->confirmTooltips[$this->mode];
        $this->viewData["xsrf_token"]  = $this->GenerateXSRFToken();
    }

    private function GenerateXSRFToken()
    {
        $tmpStr = "funciones_formulario" . time() . rand(10000, 99999);
        $this->xsrfToken = md5($tmpStr);
        $_SESSION[FUNCIONES_XSRF_KEY] = $this->xsrfToken;
        return $this->xsrfToken;
    }
}