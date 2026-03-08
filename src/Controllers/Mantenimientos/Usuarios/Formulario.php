<?php

namespace Controllers\Mantenimientos\Usuarios;

use Dao\Mantenimientos\Usuarios as UsuariosDAO;
use Controllers\PublicController;
use Views\Renderer;
use Utilities\Site;

const USUARIOS_FORMULARIO_URL = "index.php?page=Mantenimientos-Usuarios-Formulario";
const USUARIOS_LISTADO_URL = "index.php?page=Mantenimientos-Usuarios-Listado";
const XSRF_KEY = "Mantenimientos_Usuarios_Formulario";

class Formulario extends PublicController
{
    private array $viewData = [];
    private array $modes = [
        "INS" => "Nuevo Usuario",
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

    private $usercod;
    private $useremail;
    private $username;
    private $userpswd;
    private $userfching;
    private $userpswdest;
    private $userpswdexp;
    private $userest;
    private $useractcod;
    private $userpswdchg;
    private $usertipo;

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
                        if (UsuariosDAO::crearUsuario(
                            $this->useremail,
                            $this->username,
                            $this->userpswd,
                            $this->userfching,
                            $this->userpswdest,
                            $this->userpswdexp,
                            $this->userest,
                            $this->useractcod,
                            $this->userpswdchg,
                            $this->usertipo
                        ) !== 0) {
                            Site::redirectToWithMsg(USUARIOS_LISTADO_URL, "Usuario creado satisfactoriamente");
                        };
                    case "UPD":
                        if (UsuariosDAO::actualizarUsuario(
                            $this->usercod,
                            $this->useremail,
                            $this->username,
                            $this->userpswd,
                            $this->userfching,
                            $this->userpswdest,
                            $this->userpswdexp,
                            $this->userest,
                            $this->useractcod,
                            $this->userpswdchg,
                            $this->usertipo
                        ) !== 0) {
                            Site::redirectToWithMsg(USUARIOS_LISTADO_URL, "Usuario actualizado satisfactoriamente");
                        };
                    case "DEL":
                        if (UsuariosDAO::eliminarUsuario(
                            $this->usercod
                        ) !== 0) {
                            Site::redirectToWithMsg(USUARIOS_LISTADO_URL, "Usuario eliminado satisfactoriamente");
                        };
                }
            }
        }
        $this->GenerarViewData();
        Renderer::render("usuarios/formulario", $this->viewData);
    }

    private function LoadPage()
    {
        $this->mode = $_GET["mode"] ?? '';
        if (!isset($this->modes[$this->mode])) {
            Site::redirectToWithMsg(USUARIOS_LISTADO_URL, "Error al cargar formulario, Intente de nuevo");
        }
        $this->usercod = intval($_GET["id"] ?? '0');
        if ($this->mode !== "INS" && $this->usercod <= 0) {
            Site::redirectToWithMsg(USUARIOS_LISTADO_URL, "Error al cargar formulario, Se requiere Id del Usuario");
        } else {
            if ($this->mode !== "INS") {
                $this->CargarDatos();
            }
        }
    }

    private function CargarDatos()
    {
        $tmpUsuario = UsuariosDAO::getUsuarioById($this->usercod);
        if (count($tmpUsuario) <= 0) {
            Site::redirectToWithMsg(USUARIOS_LISTADO_URL, "No se encontró el Usuario");
        }
        $this->useremail   = $tmpUsuario["useremail"];
        $this->username    = $tmpUsuario["username"];
        $this->userpswd    = $tmpUsuario["userpswd"];
        $this->userfching  = $tmpUsuario["userfching"];
        $this->userpswdest = $tmpUsuario["userpswdest"];
        $this->userpswdexp = $tmpUsuario["userpswdexp"];
        $this->userest     = $tmpUsuario["userest"];
        $this->useractcod  = $tmpUsuario["useractcod"];
        $this->userpswdchg = $tmpUsuario["userpswdchg"];
        $this->usertipo    = $tmpUsuario["usertipo"];
    }

    private function CapturarDatos()
    {
        $this->usercod     = intval($_POST["id"] ?? '0');
        $this->useremail   = $_POST["useremail"] ?? '';
        $this->username    = $_POST["username"] ?? '';
        $this->userpswd    = $_POST["userpswd"] ?? '';
        $this->userfching  = $_POST["userfching"] ?? '';
        $this->userpswdest = $_POST["userpswdest"] ?? '';
        $this->userpswdexp = $_POST["userpswdexp"] ?? '';
        $this->userest     = $_POST["userest"] ?? '';
        $this->useractcod  = $_POST["useractcod"] ?? '';
        $this->userpswdchg = $_POST["userpswdchg"] ?? '';
        $this->usertipo    = $_POST["usertipo"] ?? '';
        $this->xsrfToken   = $_POST["uuid"] ?? '';
    }

    private function ValidarDatos()
    {
        $sessionToken = $_SESSION[XSRF_KEY] ?? '';
        if ($this->xsrfToken !== $sessionToken) {
            Site::redirectToWithMsg(USUARIOS_LISTADO_URL, "Error al cargar formulario, Inconsistencia en la Petición");
        }
        $validateId = intval($_GET["id"] ?? '0');
        if ($validateId !== $this->usercod) {
            return false;
        }
        return true;
    }

    private function GenerarViewData()
    {
        $this->viewData["mode"]        = $this->mode;
        $this->viewData["modeDsc"]     = sprintf($this->modes[$this->mode], $this->usercod, $this->username);
        $this->viewData["id"]          = $this->usercod;
        $this->viewData["useremail"]   = $this->useremail;
        $this->viewData["username"]    = $this->username;
        $this->viewData["userpswd"]    = $this->userpswd;
        $this->viewData["userfching"]  = $this->userfching;
        $this->viewData["userpswdest"] = $this->userpswdest;
        $this->viewData["userpswdexp"] = $this->userpswdexp;
        $this->viewData["userest"]     = $this->userest;
        $this->viewData["useractcod"]  = $this->useractcod;
        $this->viewData["userpswdchg"] = $this->userpswdchg;
        $this->viewData["usertipo"]    = $this->usertipo;
        $this->viewData["isReadonly"]  = ($this->mode === 'DEL' || $this->mode === 'DSP') ? 'readonly' : '';
        $this->viewData["hideConfirm"] = $this->mode === 'DSP';
        $this->viewData["confirmToolTip"] = $this->confirmTooltips[$this->mode];
        $this->viewData["xsrf_token"]  = $this->GenerateXSRFToken();
    }

    private function GenerateXSRFToken()
    {
        $tmpStr = "usuarios_formulario" . time() . rand(10000, 99999);
        $this->xsrfToken = md5($tmpStr);
        $_SESSION[XSRF_KEY] = $this->xsrfToken;
        return $this->xsrfToken;
    }
}