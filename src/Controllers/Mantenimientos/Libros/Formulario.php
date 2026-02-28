<?php

namespace Controllers\Mantenimientos\Libros;
use Controllers\PublicController;
use Vierws\Renderer;

use Dao\Mantenimientos\Libros as LibrosDAO;
const LIST_VIEW_TAMPLATE = "Mantenimientos/Libros/listado";

class Listado extends PublicController{
    private array $librosList = [];

    public function run(): void
    {
       $this->librosList = LibrosDAO::getAllLibros();

       Renderer::render(LIST_VIEW_TAMPLATE, $this->prepareViewData());
    }

    private function prepareViewData() {
        return [
            "libros" => $this->librosList
        ];
    }
}