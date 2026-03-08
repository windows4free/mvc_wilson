<?php

namespace Controllers\Mantenimientos\Roles;

use Controllers\PublicController;
use Views\Renderer;
use Dao\Mantenimientos\Roles as RolesDAO;

const ROLES_LIST_VIEW_TEMPLATE = "mantenimientos/roles/listado";

class Listado extends PublicController
{
    private array $rolesList = [];

    public function run(): void
    {
        $this->rolesList = RolesDAO::getAllRoles();
        Renderer::render(ROLES_LIST_VIEW_TEMPLATE, $this->prepareViewData());
    }

    private function prepareViewData()
    {
        return [
            "roles" => $this->rolesList
        ];
    }
}