<div class="modal-header">
    <h4 class="modal-title">Editar Artículo</h4>
</div>
<form action="" id="formulario-editar" autocomplete="off">
    @method('PUT')
    <div class="modal-body">
    
        
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="cuenta">cuenta(*)</label>
            <div class="col-sm-8">
                <input type="text" name="cuenta" id="cuenta" class="form-control" value="{{ $item->cuenta }}" />
            </div>
        </div>
        <!-- <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="cod_barra">cod_barra</label>
            <div class="col-sm-8">
                <input type="text" name="cod_barra" id="cod_barra" class="form-control" value="{{ $item->cod_barra }}" />
            </div>
        </div> -->
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="fecha_entrada">Fecha de Entrada(*)</label>
            <div class="col-sm-8">
                <input type="text" name="fecha_entrada" id="fecha_entrada" class="form-control" value="{{ $item->fecha_entrada }}" />
            </div>
        </div> 
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="documento">documento(*)</label>
            <div class="col-sm-8">
                <input type="text" name="documento" id="documento" class="form-control" value="{{ $item->documento }}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nro_comprobante">numero de comprobante(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nro_comprobante" id="nro_comprobante" class="form-control" value="{{ $item->nro_comprobante }}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="procedencia">procedencia(*)</label>
            <div class="col-sm-8">
                <input type="text" name="procedencia" id="procedencia" class="form-control" value="{{ $item->procedencia }}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="forma_ingreso">forma de ingreso(*)</label>
            <div class="col-sm-8">
                <input type="text" name="forma_ingreso" id="forma_ingreso" class="form-control" value="{{ $item->forma_ingreso }}" />
            </div>
        </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombre_articulo">Nombre de articulo(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nombre_articulo" id="nombre_articulo" class="form-control" value="{{ $item->nombre_articulo }}" />
            </div>
        </div>


        <!-- <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombre_categoria">Categoria</label>
            <div class="col-sm-8">
                <select name="nombre_categoria" id="nombre_categoria" class="form-control">
                    <option value="">[--SELECCIONE--]</option>
                    @foreach ($categoria_articulo as $categoria)
                    <option value="{{$categoria->nombre_categoria}}">{{$categoria->nombre_categoria}}</option>
                    @endforeach
                </select>
            </div>
        </div> -->

        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombre_categoria">Categoria(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nombre_categoria" id="nombre_categoria" class="form-control" value="{{$item->nombre_categoria}}" />
            </div>
        </div>


        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="stock">stock</label>
            <div class="col-sm-8">
                <input type="text" name="stock" id="stock" class="form-control" value="{{ $item->stock }}" />
            </div>
        </div>
        
         <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="caracteristica">caracteristica(*)</label>
            <div class="col-sm-8">
                <input type="text" name="caracteristica" id="caracteristica" class="form-control" value="{{ $item->caracteristica }}" />
            </div>
        </div>
        
       <!--  <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="unidad_medida">Unidad de Medida</label>
            <div class="col-sm-8">
                <select name="unidad_medida" id="unidad_medida" class="form-control" value="{{ $item->unidad_medida}}">
                    <option value="">[--SELECIONE UNIDAD DE MEDIDA--]</option>
                    <option>UNIDAD</option>
                    <option>KILOS</option>
                    <option>METROS</option>
                </select>
            </div>
    </div>  -->
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="marca">marca</label>
            <div class="col-sm-8">
                <input type="text" name="marca" id="marca" class="form-control" value="{{ $item->marca }}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="modelo">Modelo</label>
            <div class="col-sm-8">
                <input type="text" name="modelo" id="modelo" class="form-control" value="{{ $item->modelo }}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nro_serie">Numero de Serie</label>
            <div class="col-sm-8">
                <input type="text" name="nro_serie" id="nro_serie" class="form-control" value="{{ $item->nro_serie }}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="color">color</label>
            <div class="col-sm-8">
                <input type="text" name="color" id="color" class="form-control" value="{{ $item->color }}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="precio">Precio(*)</label>
            <div class="col-sm-8">
                <input type="text" name="precio" id="precio" class="form-control" value="{{ $item->precio }}" />
            </div>
        </div>
        
        <!-- <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="estado">Estado</label>
            <div class="col-sm-8">
                <select name="estado" id="estado" class="form-control" value="{{ $item->estado }}">
                    <option value="">[--SELECIONE ESTADO--]</option>
                    <option>OPERATIVO</option>
                    <option>INOPERATIVO</option>
                </select>
            </div>
    </div> -->
               
        
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
