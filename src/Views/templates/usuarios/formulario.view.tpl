<h1>{{modeDsc}}</h1>
<section class="grid row">
    <form class="depth-0 offset-3 col-6" action="index.php?page=Mantenimientos-Usuarios-Formulario&mode={{mode}}&id={{id}}" method="POST">
        <div class="row align-center">
            <div class="col-4">
                <label for="id">Código</label>
            </div>
            <div class="col-8">
                <input type="text" value="{{id}}" disabled name="idux" id="id" readonly/>
                <input type="hidden" name="id" value="{{id}}" />
                <input type="hidden" name="uuid" value="{{xsrf_token}}" />
            </div>
        </div>
        <div class="row align-center">
            <div class="col-4">
                <label for="useremail">Email</label>
            </div>
            <div class="col-8">
                <input type="text" name="useremail" id="useremail" value="{{useremail}}" placeholder="Email del Usuario" {{isReadonly}} />
            </div>
        </div>
        <div class="row align-center">
            <div class="col-4">
                <label for="username">Usuario</label>
            </div>
            <div class="col-8">
                <input type="text" name="username" id="username" value="{{username}}" placeholder="Nombre de Usuario" {{isReadonly}} />
            </div>
        </div>
        <div class="row align-center">
            <div class="col-4">
                <label for="userpswd">Contraseña</label>
            </div>
            <div class="col-8">
                <input type="text" name="userpswd" id="userpswd" value="{{userpswd}}" placeholder="Contraseña" {{isReadonly}} />
            </div>
        </div>
        <div class="row align-center">
            <div class="col-4">
                <label for="userfching">Fecha Ingreso</label>
            </div>
            <div class="col-8">
                <input type="text" name="userfching" id="userfching" value="{{userfching}}" placeholder="Fecha de Ingreso" {{isReadonly}} />
            </div>
        </div>
        <div class="row align-center">
            <div class="col-4">
                <label for="userpswdest">Estado Contraseña</label>
            </div>
            <div class="col-8">
                <input type="text" name="userpswdest" id="userpswdest" value="{{userpswdest}}" placeholder="Estado de Contraseña" {{isReadonly}} />
            </div>
        </div>
        <div class="row align-center">
            <div class="col-4">
                <label for="userpswdexp">Expiración Contraseña</label>
            </div>
            <div class="col-8">
                <input type="text" name="userpswdexp" id="userpswdexp" value="{{userpswdexp}}" placeholder="Expiración de Contraseña" {{isReadonly}} />
            </div>
        </div>
        <div class="row align-center">
            <div class="col-4">
                <label for="userest">Estado</label>
            </div>
            <div class="col-8">
                <input type="text" name="userest" id="userest" value="{{userest}}" placeholder="Estado del Usuario" {{isReadonly}} />
            </div>
        </div>
        <div class="row align-center">
            <div class="col-4">
                <label for="useractcod">Código Activación</label>
            </div>
            <div class="col-8">
                <input type="text" name="useractcod" id="useractcod" value="{{useractcod}}" placeholder="Código de Activación" {{isReadonly}} />
            </div>
        </div>
        <div class="row align-center">
            <div class="col-4">
                <label for="userpswdchg">Cambio Contraseña</label>
            </div>
            <div class="col-8">
                <input type="text" name="userpswdchg" id="userpswdchg" value="{{userpswdchg}}" placeholder="Código Cambio de Contraseña" {{isReadonly}} />
            </div>
        </div>
        <div class="row align-center">
            <div class="col-4">
                <label for="usertipo">Tipo Usuario</label>
            </div>
            <div class="col-8">
                <input type="text" name="usertipo" id="usertipo" value="{{usertipo}}" placeholder="Tipo de Usuario" {{isReadonly}} />
            </div>
        </div>
        {{if confirmToolTip}}
            <div class="error">
                {{confirmToolTip}}
            </div>
        {{endif confirmToolTip}}
        <div class="right">
            {{ifnot hideConfirm}}
            <button type="submit" name="btnEnviar">Confirmar</button>
            {{endifnot hideConfirm}}
            &nbsp;
            <button id="btnCancelar">Cancelar</button>
        </div>
    </form>
</section>
<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById("btnCancelar").addEventListener("click", (e)=>{
            e.preventDefault();
            e.stopPropagation();
            window.location.assign("index.php?page=Mantenimientos-Usuarios-Listado");
        });
    });
</script>