<div class="modal-header">
    <h4 class="modal-title">Editar Entradas</h4>
</div>
<form action="" id="formulario-editar" autocomplete="off">
    @method('PUT')
    <div class="modal-body">
    
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombre_articulo">Cantidad</label>
            <div class="col-sm-8">
                <input type="text" name="nombre_articulo" id="nombre_articulo" class="form-control"  value="{{ $item->nombre_articulo }}" />
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="cantidad">Cantidad</label>
            <div class="col-sm-8">
                <input type="text" name="cantidad" id="cantidad" class="form-control" placeholder="Ingrese la Cantidad" value="{{ $item->cantidad }}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="fecha_entrada">fecha de entrada(*)</label>
            <div class="col-sm-8">
                <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control" value="{{ $item->fecha_entrada }}" />
            </div>
        </div>
        <!-- <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="proveedor">Proveedor</label>
            <div class="col-sm-8">
                <select type="text" name="proveedor" id="proveedor" class="form-control">
                    <option value="">[--SELECCIONE--]</option>
                    @foreach ($proveedor_entrada as $proveedor)
                        <option value="{{ $proveedor->nombre_proveedor}}">{{ $proveedor->nombre_proveedor}}</option>
                    @endforeach
                </select>
            </div>
        </div> -->

        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="proveedor">Proveedor(*)</label>
            <div class="col-sm-8">
                <input type="text" name="proveedor" id="proveedor" class="form-control" placeholder="Ingrese Nombre de Proveedor" value="{{ $item->proveedor}}" />
            </div>
        </div>


        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="precio">Precio(*)</label>
            <div class="col-sm-8">
                <input type="text" name="precio" id="precio" class="form-control" placeholder="Ingrese la Precio" value="{{ $item->precio }}" />
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
