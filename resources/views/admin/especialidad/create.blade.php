<div class="modal-header">
    <h4 class="modal-title">Registrar programa</h4>
</div>
<form action="" id="formulario-crear" autocomplete="off">
    <div class="modal-body">
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="cod_especialidad">Codigo de Especialidad(*)</label>
            <div class="col-sm-8">
                <input type="text" name="cod_especialidad" id="cod_especialidad" class="form-control" placeholder="Ingrese Codigo de Especialidad"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombre_especialidad">Nombre de Especialidad(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nombre_especialidad" id="nombre_especialidad" class="form-control" placeholder="Ingrese Nombre de Especialidad" />
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
