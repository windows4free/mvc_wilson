<?php

namespace Controllers\Productos;

use Controllers\PublicController;
use Views\Renderer;


class Hello extends PublicController
{

    private string $txtNombre = "";
    private string $txtResultado = "";
    private array $viewData = [];
    public function run(): void
    {

        if($this->isPostBack()){
            $this->txtNombre = $_POST["txtNombre"] ?? "";
            if($this->txtNombre === ""){
                $this->txtResultado = "Error: El nombre nombre viene vacio!!";
            } else {
            $this->txtResultado = "Hola " . $this->txtNombre;
        }
    }

        $this->preparaViewData();
        Renderer::render("productos/hello", $this->viewData);
    }


    private function preparaViewData (): void
    {
        $this->viewData = [
            "txtNombre" => $this->txtNombre
        ];
        $this->viewData["mensajefinal"] = $this->txtResultado;
     }
}