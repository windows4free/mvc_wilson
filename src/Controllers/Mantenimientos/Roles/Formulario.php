<?php

namespace Controllers\Mantenimientos\Roles;

use Dao\Mantenimientos\Roles as RolesDAO;
use Controllers\PublicController;
use Views\Renderer;
use Utilities\Site;

const ROLES_FORMULARIO_URL = "index.php?page=Mantenimientos-Roles-Formulario";
const ROLES_LISTADO_URL = "index.php?page=Mantenimientos-Roles-Listado";
const XSRF_KEY = "Mantenimientos_Roles_Formulario";

class Formulario extends PublicController
{
    private array $viewData = [];
    private array $modes = [
        "INS" => "Nuevo Rol",
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

    private $rolescod;
    private $rolesdsc;
    private $rolesest;

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
                        if (RolesDAO::crearRol(
                            $this->rolescod,
                            $this->rolesdsc,
                            $this->rolesest
                        ) !== 0) {
                            Site::redirectToWithMsg(ROLES_LISTADO_URL, "Rol creado satisfactoriamente");
                        };
                    case "UPD":
                        if (RolesDAO::actualizarRol(
                            $this->rolescod,
                            $this->rolesdsc,
                            $this->rolesest
                        ) !== 0) {
                            Site::redirectToWithMsg(ROLES_LISTADO_URL, "Rol actualizado satisfactoriamente");
                        };
                    case "DEL":
                        if (RolesDAO::eliminarRol(
                            $this->rolescod
                        ) !== 0) {
                            Site::redirectToWithMsg(ROLES_LISTADO_URL, "Rol eliminado satisfactoriamente");
                        };
                }
            }
        }
        $this->GenerarViewData();
        Renderer::render("mantenimientos/roles/formulario", $this->viewData);
    }

    private function LoadPage()
    {
        $this->mode = $_GET["mode"] ?? '';
        if (!isset($this->modes[$this->mode])) {
            Site::redirectToWithMsg(ROLES_LISTADO_URL, "Error al cargar formulario, Intente de nuevo");
        }
        $this->rolescod = $_GET["id"] ?? '';
        if ($this->mode !== "INS" && empty($this->rolescod)) {
            Site::redirectToWithMsg(ROLES_LISTADO_URL, "Error al cargar formulario, Se requiere Id del Rol");
        } else {
            if ($this->mode !== "INS") {
                $this->CargarDatos();
            }
        }
    }

    private function CargarDatos()
    {
        $tmpRol = RolesDAO::getRolById($this->rolescod);
        if (count($tmpRol) <= 0) {
            Site::redirectToWithMsg(ROLES_LISTADO_URL, "No se encontró el Rol");
        }
        $this->rolesdsc = $tmpRol["rolesdsc"];
        $this->rolesest = $tmpRol["rolesest"];
    }

    private function CapturarDatos()
    {
        $this->rolescod  = $_POST["rolescod"] ?? '';
        $this->rolesdsc  = $_POST["rolesdsc"] ?? '';
        $this->rolesest  = $_POST["rolesest"] ?? '';
        $this->xsrfToken = $_POST["uuid"] ?? '';
    }

    private function ValidarDatos()
    {
        $sessionToken = $_SESSION[XSRF_KEY] ?? '';
        if ($this->xsrfToken !== $sessionToken) {
            Site::redirectToWithMsg(ROLES_LISTADO_URL, "Error al cargar formulario, Inconsistencia en la Petición");
        }
        $validateId = $_GET["id"] ?? '';
        if ($validateId !== $this->rolescod) {
            return false;
        }
        return true;
    }

    private function GenerarViewData()
    {
        $this->viewData["mode"]        = $this->mode;
        $this->viewData["modeDsc"]     = sprintf($this->modes[$this->mode], $this->rolescod, $this->rolesdsc);
        $this->viewData["id"]          = $this->rolescod;
        $this->viewData["rolescod"]    = $this->rolescod;
        $this->viewData["rolesdsc"]    = $this->rolesdsc;
        $this->viewData["rolesest"]    = $this->rolesest;
        $this->viewData["isReadonly"]  = ($this->mode === 'DEL' || $this->mode === 'DSP') ? 'readonly' : '';
        $this->viewData["hideConfirm"] = $this->mode === 'DSP';
        $this->viewData["confirmToolTip"] = $this->confirmTooltips[$this->mode];
        $this->viewData["xsrf_token"]  = $this->GenerateXSRFToken();
    }

    private function GenerateXSRFToken()
    {
        $tmpStr = "roles_formulario" . time() . rand(10000, 99999);
        $this->xsrfToken = md5($tmpStr);
        $_SESSION[XSRF_KEY] = $this->xsrfToken;
        return $this->xsrfToken;
    }
}