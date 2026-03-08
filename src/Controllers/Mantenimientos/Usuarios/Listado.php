<?php

namespace Controllers\Mantenimientos\Usuarios;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Mantenimientos\Usuarios as UsuariosDAO;

const LIST_VIEW_TEMPLATE = "usuarios/listado";

class Listado extends PublicController
{
    private array $usuariosList = [];

    public function run(): void
    {
        $this->usuariosList = UsuariosDAO::getAllUsuarios();
        Renderer::render(LIST_VIEW_TEMPLATE, $this->prepareViewData());
    }

    private function prepareViewData()
    {
        return [
            "usuarios" => $this->usuariosList
        ];
    }
}