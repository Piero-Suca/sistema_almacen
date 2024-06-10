<div class="modal-header">
    <h4 class="modal-title">Registrar Artículo</h4>
</div>
<form action="" id="formulario-crear" autocomplete="off">
    <div class="modal-body">

    
   
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="cuenta">Cuenta(*)</label>
            <div class="col-sm-8">
                <input type="text" name="cuenta" id="cuenta" class="form-control" placeholder="Ingrese el Numero de Cuenta"/>
            </div>
    </div>
    <!-- <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="cod_barra">Codigo de Barra</label>
            <div class="col-sm-8">
                <input type="text" name="cod_barra" id="cod_barra" class="form-control" placeholder="Ingrese el Codigo de Barras"/>
            </div>
    </div> -->
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="fecha_entrada">Fecha de Entrada(*)</label>
            <div class="col-sm-8">
                <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control" />
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="documento">Comprobante(*)</label>
            <div class="col-sm-8">
                <select name="documento" id="documento" class="form-control">
                    <option value="">[--SELECIONE COMPROBANTE--]</option>
                    <option>BOLETA</option>
                    <option>FACTURA</option>
                    <option>DONACION</option>
                </select>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nro_comprobante">Numero de Comprobante(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nro_comprobante" id="nro_comprobante" class="form-control" placeholder="Ingrese el Numero de Comprobante"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="procedencia">Procedencia(*)</label>
            <div class="col-sm-8">
                <select name="procedencia" id="procedencia" class="form-control">
                    <option value="">[--SELECIONE PROCEDENCIA--]</option>
                    <option>RECURSOS PROPIOS</option>
                    <option>DRE.CUSCO</option>
                    <option>PRONIED</option>
                    <option>OTROS</option>
                </select>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="forma_ingreso">Forma de Ingreso(*)</label>
            <div class="col-sm-8">
                <select name="forma_ingreso" id="forma_ingreso" class="form-control">
                    <option value="">[--SELECIONE LA FORMA DE INGRESO--]</option>
                    <option>COMPRADO</option>
                    <option>DONADO</option>8
                </select>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombre_articulo" >Nombre de articulo(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nombre_articulo" id="nombre_articulo" class="form-control" placeholder="Ingrese nombre de articulo"/>
            </div>
    </div>


     <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="nombre_categoria">Categoria(*)</label>
            <div class="col-sm-8">
                <select name="nombre_categoria" id="nombre_categoria" class="form-control" >
                    <option value="">[--SELECCIONE--]</option>
                    @foreach ($categoria as $categoria)
                        <option value="{{ $categoria->nombre_categoria }}">{{ $categoria->nombre_categoria}}</option>
                    @endforeach
                </select>
            </div>
        </div>
   
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="caracteristica">caracteristica(*)</label>
            <div class="col-sm-8">
                <input type="text" name="caracteristica" id="caracteristica" class="form-control" placeholder="Ingrese la Caracteristica" />
            </div>
        </div>

    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="stock">Stock</label>
            <div class="col-sm-8">
                <input type="text" name="stock" id="stock" class="form-control" placeholder="Ingrese la Cantidad"/>
            </div>
    </div>
    <!-- <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="unidad_medida">Unidad de Medida</label>
            <div class="col-sm-8">
                <select name="unidad_medida" id="unidad_medida" class="form-control">
                    <option value="">[--SELECIONE UNIDAD DE MEDIDA--]</option>
                    <option>UNIDAD</option>
                    <option>KILOS</option>
                    <option>METROS</option>
                </select>
            </div>
    </div>  -->
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="marca">Marca</label>
            <div class="col-sm-8">
                <input type="text" name="marca" id="marca" class="form-control" placeholder="Ingrese la Marca"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="modelo">Modelo</label>
            <div class="col-sm-8">
                <input type="text" name="modelo" id="modelo" class="form-control" placeholder="Ingrese el Modelo"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nro_serie">Numero de Serie</label>
            <div class="col-sm-8">
                <input type="text" name="nro_serie" id="nro_serie" class="form-control" placeholder="Ingrese su numero de serie"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="color">Color</label>
            <div class="col-sm-8">
                <input type="text" name="color" id="color" class="form-control" placeholder="Ingrese el color"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="precio">Precio(*)</label>
            <div class="col-sm-8">
                <input type="text" name="precio" id="precio" class="form-control" placeholder="Ingrese el precio"/>
            </div>
    </div>
    <!-- <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="estado">Estado</label>
            <div class="col-sm-8">
                <select name="estado" id="estado" class="form-control">
                    <option value="">[--SELECIONE ESTADO--]</option>
                    <option>OPERATIVO</option>
                    <option>INOPERATIVO</option>
                </select>
            </div>
    </div>  -->
    
    
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
