<div class="modal-header">
    <h4 class="modal-title">Registrar Entradas</h4>
</div>
<form action="" id="formulario-crear" autocomplete="off">
<div class="modal-body">
    
    <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="nombre_articulo">Nombre de Articulo(*)</label>
    <div class="col-sm-8">
                <select name="nombre_articulo" id="nombre_articulo" class="form-control">
                    <option value="">[--SELECCIONE--]</option>
                    @foreach ($articulos as $articulo)
                        <option value="{{ $articulo->nombre_articulo}}">{{ $articulo->nombre_articulo}}</option>
                    @endforeach
                </select>
    </div>
    </div>


    

    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="cantidad">Cantidad</label>
            <div class="col-sm-8">
                <input type="text" name="cantidad" id="cantidad" class="form-control" placeholder="Ingrese la Cantidad"/>
            </div>
    </div>

    
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="fecha_entrada">Fecha de entrada(*)</label>
            <div class="col-sm-8">
                <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control" />
            </div>
    </div>
    <!-- <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="proveedor">Proveedor</label>
            <div class="col-sm-8">
                <input type="text" name="proveedor" id="proveedor" class="form-control" />
            </div>
    </div> -->
    <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="proveedor">Proveedor(*)</label>
            <div class="col-sm-8">
                <select name="proveedor" id="proveedor" class="form-control">
                    <option value="">[--SELECCIONE--]</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->nombre_proveedor}}">{{ $proveedor->nombre_proveedor}}</option>
                    @endforeach
                </select>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="precio">Precio(*)</label>
            <div class="col-sm-8">
                <input type="text" name="precio" id="precio" class="form-control" placeholder="Ingrese el Precio"/>
            </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-window-close"></i> Cerrar
        </button>
        <button id="btn-submit" type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
            Registrar</button>
    </div>
</div>
</form>
<script>
    document.getElementById("formulario-crear").addEventListener('submit', function(evento) {
        evento.preventDefault();
        guardar();
    });
</script>
