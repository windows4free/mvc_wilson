<?php
// CRUD. (Create, Read, Update Delete) 
//       ( Insert, Select, Update, Delete)
//       ( INS, DSP, UPD, DEL)

namespace Controllers\Mantenimientos\Usuarios;

use Controllers\PublicController;
use Views\Renderer;

use Dao\Mantenimientos\Usuarios as LibrosDAO;

const LIST_VIEW_TEMPLATE = "mantenimientos/usuarios/listado";

class Listado extends PublicController
{

    private array $librosList = [];
    public function run(): void
    {
        $this->librosList = LibrosDAO::getAllLibros();
        Renderer::render(LIST_VIEW_TEMPLATE, $this->prepareViewData());
    }

    private function prepareViewData()
    {
        return [
            "libros" => $this->librosList
        ];
    }
}
