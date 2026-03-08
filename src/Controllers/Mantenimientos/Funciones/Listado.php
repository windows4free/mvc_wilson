<?php

namespace Controllers\Mantenimientos\Funciones;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Mantenimientos\Funciones as FuncionesDAO;

const FUNCIONES_LIST_VIEW_TEMPLATE = "mantenimientos/funciones/listado";

class Listado extends PublicController
{
    private array $funcionesList = [];

    public function run(): void
    {
        $this->funcionesList = FuncionesDAO::getAllFunciones();
        Renderer::render(FUNCIONES_LIST_VIEW_TEMPLATE, $this->prepareViewData());
    }

    private function prepareViewData()
    {
        return [
            "funciones" => $this->funcionesList
        ];
    }
}