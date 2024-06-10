<div class="modal-header">
    <h4 class="modal-title">Editar tipo de curso</h4>
</div>
<form action="" id="formulario-editar" autocomplete="off">
    @method('PUT')
    <div class="modal-body">
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="cod_proveedor">codigo de Proveedor(*)</label>
            <div class="col-sm-8">
                <input type="text" name="cod_proveedor" id="cod_proveedor" class="form-control" placeholder="Ingrese el Codigo de Proveedor" value="{{ $item->cod_proveedor }}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombre_proveedor">Nombre de Proveedor(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nombre_proveedor" id="nombre_proveedor" class="form-control" placeholder="Ingrese el Nombre de Proveedor" value="{{ $item->nombre_proveedor }}" />
            </div>

            <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="direccion">Direccion</label>
            <div class="col-sm-8">
                <input type="text" name="direccion" id="direccion" class="form-control" placeholder="Ingrese la Direccion" value="{{ $item->direccion }}" />
            </div>

            <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nro_celular">Numero de Celular</label>
            <div class="col-sm-8">
                <input type="text" name="nro_celular" id="nro_celular" class="form-control" placeholder="Ingrese el Numero de Celular" value="{{ $item->nro_celular}}" />
            </div>
        
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-window-close"></i> Cerrar
        </button>
        <button id="btn-submit" type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
            Actualizar</button>
    </div>
</form>
<script>
    document.getElementById("formulario-editar").addEventListener('submit', function(evento) {
        evento.preventDefault();
        actualizar({{ $item->id }});
    });
</script>
