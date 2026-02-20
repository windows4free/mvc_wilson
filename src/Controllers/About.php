<?php


namespace Controllers;


use Views\Renderer;
class About extends PublicController{

    public function run(): void
    {
       $viewDara = [
        "nombre" => "Wilson Vargas",
        "correo" => "wilsonvargad5@gmail.com",
        "telefono" => "0000-0000"
       ];

         Renderer::render("about", $viewDara);
    }
}