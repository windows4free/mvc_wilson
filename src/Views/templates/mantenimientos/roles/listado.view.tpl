<section class="container">
    <table class="">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>
                    <a href="index.php?page=Mantenimientos-Roles-Formulario&mode=INS&id=0">Nuevo</a>
                </th>
            </tr>
        </thead>
        <tbody>
            {{foreach roles}}
            <tr>
                <td>{{rolescod}}</td>
                <td>{{rolesdsc}}</td>
                <td>{{rolesest}}</td>
                <td>
                    <a href="index.php?page=Mantenimientos-Roles-Formulario&mode=DSP&id={{rolescod}}">Mostrar</a>
                    <br/>
                    <a href="index.php?page=Mantenimientos-Roles-Formulario&mode=UPD&id={{rolescod}}">Actualizar</a>
                    <br/>
                    <a href="index.php?page=Mantenimientos-Roles-Formulario&mode=DEL&id={{rolescod}}">Eliminar</a>
                </td>
            </tr>
            {{endfor roles}}
        </tbody>
    </table>
</section>