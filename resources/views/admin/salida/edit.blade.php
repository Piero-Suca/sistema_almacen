<div class="modal-header">
    <h4 class="modal-title">Editar Salida</h4>
</div>
<form action="" id="formulario-editar" autocomplete="off">
    @method('PUT')
    <div class="modal-body">
        <div class="form-group row">
            
            <div class="col-sm-8">
                
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="cod_persona">Codigo de Persona(*)</label>
            <div class="col-sm-8">
                <input type="text" name="cod_persona" id="cod_persona" class="form-control" value="{{ $item->cod_persona}}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombres">Nombre y Apellido(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nombres" id="nombres" class="form-control" value="{{ $item->nombres}}" />
            </div>
    </div>
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="nombre_articulo">Nombre de Articulo(*)</label>
            <div class="col-sm-8">
                <input name="nombre_articulo" id="nombre_articulo" class="form-control" value="{{ $item->nombre_articulo }}">
                    
            </div>
    </div>
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="cantidad">Cantidad(*)</label>
            <div class="col-sm-8">
                <input type="text" name="cantidad" id="cantidad" class="form-control" value="{{ $item->cantidad}}" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="unidad_medida">Unidad de Medida(*)</label>
            <div class="col-sm-8">
                <input name="unidad_medida" id="unidad_medida" class="form-control" value="{{$item->unidad_medida}}">
                    
            </div>
    </div> 
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="fecha_salida">Fecha de salida(*)</label>
            <div class="col-sm-8">
                <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" value="{{ $item->fecha_salida}}" />
            </div>
        </div>  
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="tipo_salida">Tipo de Salida(*)</label>
            <div class="col-sm-8">
                <input name="tipo_salida" id="tipo_salida" class="form-control" value="{{$item->tipo_salida}}">
                    
            </div>
    </div> 
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="fecha_retorno">fecha de retorno(*)</label>
            <div class="col-sm-8">
                <input type="date" name="fecha_retorno" id="fecha_retorno" class="form-control" value="{{ $item->fecha_retorno}}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="observaciones">Obervaciones(*)</label>
            <div class="col-sm-8">
                <input name="observaciones" id="observaciones" class="form-control" value="{{ $item->observaciones}}">
                    
            </div>
    </div> 

    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="devoluciones">Devoluciones(*)</label>
            <div class="col-sm-8">
                <input name="devoluciones" id="devoluciones" class="form-control" value="{{ $item->devoluciones}}">

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
