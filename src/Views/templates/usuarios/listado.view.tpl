<section class="container">
    <table class="">
        <thead>
            <tr>
                <th>Código</th>
                <th>Email</th>
                <th>Usuario</th>
                <th>Tipo</th>
                <th>Estado</th>
                <th>
                    <a href="index.php?page=Mantenimientos-Usuarios-Formulario&mode=INS&id=0">Nuevo</a>
                </th>
            </tr>
        </thead>
        <tbody>
            {{foreach usuarios}}
            <tr>
                <td>{{usercod}}</td>
                <td>{{useremail}}</td>
                <td>{{username}}</td>
                <td>{{usertipo}}</td>
                <td>{{userest}}</td>
                <td>
                    <a href="index.php?page=Mantenimientos-Usuarios-Formulario&mode=DSP&id={{usercod}}">Mostrar</a>
                    <br/>
                    <a href="index.php?page=Mantenimientos-Usuarios-Formulario&mode=UPD&id={{usercod}}">Actualizar</a>
                    <br/>
                    <a href="index.php?page=Mantenimientos-Usuarios-Formulario&mode=DEL&id={{usercod}}">Eliminar</a>
                </td>
            </tr>
            {{endfor usuarios}}
        </tbody>
    </table>
</section>