<div class="modal-header">
    <h4 class="modal-title">Registrar Salida</h4>
</div>
<form method="GET" action="" id="formulario-crear" autocomplete="off">
    <div class="modal-body">

        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="cod_persona">Ingrese el DNI(*)</label>
            <div class="col-sm-8">
                <input type="text" name="cod_persona" id="cod_persona" class="form-control" placeholder="Ingrese el Código de Persona" required/>
            </div>
            
        </div>
            


        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombres">Nombre(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nombres" id="nombres" class="form-control" readonly />
            </div>
            
            
        </div>

        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="apellidos">Apellido(*)</label>
            <div class="col-sm-8">
                <input type="text" name="apellidos" id="apellidos" class="form-control" readonly/>
            </div>
        </div>

        <!-- Resto del formulario -->
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="nombre_articulo">Nombre de Articulo(*)</label>
            <div class="col-sm-8">
                <select name="nombre_articulo" id="nombre_articulo" class="form-control">
                    <option value="">[--SELECCIONE--]</option>
                    @foreach ($articulo as $articulo)
                        <option value="{{ $articulo->nombre_articulo }}">{{ $articulo->nombre_articulo}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="cantidad">Cantidad(*)</label>
            <div class="col-sm-8">
                <input type="text" name="cantidad" id="cantidad" class="form-control" />
            </div>
        </div>  
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="unidad_medida">Unidad de Medida(*)</label>
            <div class="col-sm-8">
                <select name="unidad_medida" id="unidad_medida" class="form-control">
                    <option value="">[--SELECIONE UNIDAD DE MEDIDA--]</option>
                    <option>UNIDAD</option>
                    <option>KILOS</option>
                    <option>METROS</option>
                </select>
            </div>
        </div> 
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="fecha_salida">fecha de salida(*)</label>
            <div class="col-sm-8">
                <input type="date" name="fecha_salida" id="fecha_salida" class="form-control" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="tipo_salida">Tipo de Salida(*)</label>
            <div class="col-sm-8">
                <select name="tipo_salida" id="tipo_salida" class="form-control">
                    <option value="">[--SELECIONE TIPO DE SALIDA--]</option>
                    <option>RETORNABLE</option>
                    <option>NO RETORNABLE</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="fecha_retorno">fecha de retorno(*)</label>
            <div class="col-sm-8">
                <input type="date" name="fecha_retorno" id="fecha_retorno" class="form-control" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="observaciones">Obervaciones(*)</label>
            <div class="col-sm-8">
                <select name="observaciones" id="observaciones" class="form-control">
                    <option value="">[--SELECIONE OBSERVACIONES--]</option>
                    <option>BUENAS CONDICIONES</option>
                    <option>MALO</option>
                    <option>EN DESUSO/DADO DE BAJA</option>
                    <option>EN USO</option>
                    <option>NUEVO</option>
                    <option>DADA DE BAJA</option>
                </select>
            </div>
        </div> 
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="devoluciones">Devoluciones(*)</label>
            <div class="col-sm-8">
                <select name="devoluciones" id="devoluciones" class="form-control">
                    <option>NO DEVUELTO</option>
                    <option>DEVUELTO</option>
                </select> 
            </div>
        </div>

        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fas fa-window-close"></i> Cerrar</button>
            <button id="btn-submit" type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Registrar</button>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="llamado.js"></script>

<script>
    document.getElementById("formulario-crear").addEventListener('submit', function(evento) {
        evento.preventDefault();
        guardar();
    });
</script>


<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#cod_persona').on('input', function() {
            var cod_persona = $(this).val();
            if (cod_persona.length > 0) {
                $.ajax({
                    url: '/buscar-persona',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        cod_persona: cod_persona
                    },
                    success: function(response) {
                        if (response.error) {
                            alert(response.error);
                        } else {
                            $('#nombres').val(response.nombres);
                            $('#apellidos').val(response.apellidos);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                $('#nombres').val('');
                $('#apellidos').val('');
            }
        });

        $('#formulario-crear').submit(function(evento) {
            evento.preventDefault();
            guardar();
        });

        function guardar() {
            // Aquí puedes agregar la lógica para guardar los datos del formulario
            console.log("Formulario enviado");
        }
    });
</script> -->