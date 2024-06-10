<div class="modal-header">
    <h4 class="modal-title">Editar Docente</h4>
</div>
<form action="" id="formulario-editar" autocomplete="off">
    @method('PUT')
    <div class="modal-body">
        <div class="form-group row">
            
            <div class="col-sm-8">
                
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="cod_oficina">Codigo de Oficina(*)</label>
            <div class="col-sm-8">
                <input type="text" name="cod_oficina" id="cod_oficina" class="form-control" placeholder="Ingrese Codigo de Oificina" value="{{ $item->cod_oficina}}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="nombre_oficina">Nombre de Oficina(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nombre_oficina" id="nombre_oficina" class="form-control" placeholder="Ingrese Nombre de Oficina" value="{{ $item->nombre_oficina}}" />
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
