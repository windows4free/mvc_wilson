<h1>{{modeDsc}}</h1>
<section class="grid row">
    <form class="depth-0 offset-3 col-6" action="index.php?page=Mantenimientos-Roles-Formulario&mode={{mode}}&id={{id}}" method="POST">
        <div class="row align-center">
            <div class="col-4">
                <label for="rolescod">Código</label>
            </div>
            <div class="col-8">
                <input type="text" value="{{rolescod}}" disabled name="rolescodux" id="rolescod" readonly/>
                <input type="hidden" name="rolescod" value="{{rolescod}}" />
                <input type="hidden" name="uuid" value="{{xsrf_token}}" />
            </div>
        </div>
        <div class="row align-center">
            <div class="col-4">
                <label for="rolesdsc">Descripción</label>
            </div>
            <div class="col-8">
                <input type="text" name="rolesdsc" id="rolesdsc" value="{{rolesdsc}}" placeholder="Descripción del Rol" {{isReadonly}} />
            </div>
        </div>
        <div class="row align-center">
            <div class="col-4">
                <label for="rolesest">Estado</label>
            </div>
            <div class="col-8">
                <input type="text" name="rolesest" id="rolesest" value="{{rolesest}}" placeholder="Estado del Rol" {{isReadonly}} />
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
            window.location.assign("index.php?page=Mantenimientos-Roles-Listado");
        });
    });
</script>