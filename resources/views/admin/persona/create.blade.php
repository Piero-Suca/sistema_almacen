<div class="modal-header">
    <h4 class="modal-title">Registrar programa</h4>
</div>
<form action="" id="formulario-crear" autocomplete="off">
    <div class="modal-body">
    
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="cod_persona">Codigo de Persona(*)</label>
            <div class="col-sm-8">
                <input type="text" name="cod_persona" id="cod_persona" class="form-control" placeholder="Ingrese el DNI de Persona"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombres">Nombres(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Ingrese Nombres"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="apellidos">Apellidos(*)</label>
            <div class="col-sm-8">
                <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Ingrese Apellidos"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nro_celular">Numero de celular</label>
            <div class="col-sm-8">
                <input type="text" name="nro_celular" id="nro_celular" class="form-control" placeholder="Ingrese Numero de Celular"/>
            </div>
    </div>

    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="tipo_persona">Tipo de Persona(*)</label>
            <div class="col-sm-8">
                <select name="tipo_persona" id="tipo_persona" class="form-control" >
                <option >--------SELECIONE---------</option>
                <option value="estudiante">Estudiante</option>
                <option value="docente">Docente</option>
                <option value="personal">Personal</option>
                </select>
            </div>
        </div>
         
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-window-close"></i> Cerrar
        </button>
        <button id="btn-submit" type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
            Registrar</button>
    </div>
</form>
<script>
    document.getElementById("formulario-crear").addEventListener('submit', function(evento) {
        evento.preventDefault();
        guardar();
    });
</script>
