<div class="modal-header">
    <h4 class="modal-title">Editar tipo de curso</h4>
</div>
<form action="" id="formulario-editar" autocomplete="off">
    @method('PUT')
    <div class="modal-body">
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="cod_programa">Programa de Estudio(*)</label>
            <div class="col-sm-8">
                <input type="text" name="cod_programa" id="cod_programa" class="form-control" placeholder="Ingrese el Codigo de Programa" value="{{ $item->cod_programa }}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombre_programa">Nombre del Programa(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nombre_programa" id="nombre_programa" class="form-control" placeholder="Ingrese el Nombre de Programa" value="{{ $item->nombre_programa }}" />
            </div>
        </div>

       
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="anio_creacion">Año de Creacion(*)</label>
            <div class="col-sm-8">
                <input type="text" name="anio_creacion" id="anio_creacion" class="form-control" placeholder="Ingrese el Año de Creacion" value="{{ $item->anio_creacion }}" />
            </div>
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
