<h1>{{modeDsc}}</h1>
<section class="grid row">
    <form class="depth-0 offset-3 col-6" action="index.php?page=Mantenimientos-Funciones-Formulario&mode={{mode}}&id={{id}}" method="POST">
        <div class="row align-center">
            <div class="col-4">
                <label for="fncod">Código</label>
            </div>
            <div class="col-8">
                <input type="text" value="{{fncod}}" disabled name="fncodux" id="fncod" readonly/>
                <input type="hidden" name="fncod" value="{{fncod}}" />
                <input type="hidden" name="uuid" value="{{xsrf_token}}" />
            </div>
        </div>
        <div class="row align-center">
            <div class="col-4">
                <label for="fndsc">Descripción</label>
            </div>
            <div class="col-8">
                <input type="text" name="fndsc" id="fndsc" value="{{fndsc}}" placeholder="Descripción de la Función" {{isReadonly}} />
            </div>
        </div>
        <div class="row align-center">
            <div class="col-4">
                <label for="fnest">Estado</label>
            </div>
            <div class="col-8">
                <input type="text" name="fnest" id="fnest" value="{{fnest}}" placeholder="Estado de la Función" {{isReadonly}} />
            </div>
        </div>
        <div class="row align-center">
            <div class="col-4">
                <label for="fntyp">Tipo</label>
            </div>
            <div class="col-8">
                <input type="text" name="fntyp" id="fntyp" value="{{fntyp}}" placeholder="Tipo de Función" {{isReadonly}} />
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
            window.location.assign("index.php?page=Mantenimientos-Funciones-Listado");
        });
    });
</script>