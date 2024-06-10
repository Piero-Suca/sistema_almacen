<div class="modal-header">
    <h4 class="modal-title">Registrar Proveedor</h4>
</div>
<form action="" id="formulario-crear" autocomplete="off">
    <div class="modal-body">
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="cod_proveedor">Codigo de Proveedor(*)</label>
            <div class="col-sm-8">
                <input type="text" name="cod_proveedor" id="cod_proveedor" class="form-control" placeholder="Ingrese el Codigo de Proveedor"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombre_proveedor">Nombre de Proveedor(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nombre_proveedor" id="nombre_proveedor" class="form-control" placeholder="Ingrese el Nombre de Proveedor"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="direccion">Direccion</label>
            <div class="col-sm-8">
                <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese la Direccion"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nro_celular">Numero de Celular</label>
            <div class="col-sm-8">
                <input type="text" name="nro_celular" id="nro_celular" class="form-control" placeholder="Ingrese el Numero de Celular"/>
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
