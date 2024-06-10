<div class="modal-header">
    <h4 class="modal-title">Registrar estudiante</h4>
</div>
<form action="" id="formulario-crear" autocomplete="off">
    <div class="modal-body">
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="programa_id">Tipo Programa(*)</label>
            <div class="col-sm-8">
                <select name="programa_id" id="programa_id" class="form-control">
                    <option value="">[--SELECCIONE--]</option>
                    @foreach ($programas as $programa)
                        <option value="{{ $programa->nombre_programa }}">{{ $programa->nombre_programa}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
    <label class="col-sm-4 col-form-label" for="nombre">Nombre(*)</label>
    <div class="col-sm-8">
        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese el Nombre del estudiante"/>
    </div>
</div>

<script>
    // Seleccionar el campo de entrada por su ID
    const nombreInput = document.getElementById('nombre');

    // Agregar un listener para el evento 'input'
    nombreInput.addEventListener('input', function() {
        // Convertir el valor del campo de entrada a mayúsculas
        const nombreMayusculas = this.value.toUpperCase();
        
        // Asignar el valor en mayúsculas de vuelta al campo de entrada
        this.value = nombreMayusculas;
    });
</script>

        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="apellidos">Apellidos(*)</label>
            <div class="col-sm-8">
                <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Ingrese Apellidos"/>
            </div>
            <script>
    // Seleccionar el campo de entrada por su ID
    const apellidosInput = document.getElementById('apellidos');

    // Agregar un listener para el evento 'input'
    apellidosInput.addEventListener('input', function() {
        // Convertir el valor del campo de entrada a mayúsculas
        const apellidosMayusculas = this.value.toUpperCase();
        
        // Asignar el valor en mayúsculas de vuelta al campo de entrada
        this.value = apellidosMayusculas;
    });
</script>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nro_celular">Celular</label>
            <div class="col-sm-8">
                <input type="text" name="nro_celular" id="nro_celular" class="form-control" placeholder="Ingrese Numero de Celular"/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="dni">Dni(*)</label>
            <div class="col-sm-8">
                <input type="text" name="dni" id="dni" class="form-control" placeholder="Ingrese el Dni del Estudiante"/>
            </div>
        </div>
        <!-- <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="semestre">semestre</label>
            <div class="col-sm-8">
                <input type="text" name="semestre" id="semestre" class="form-control" />
            </div>
        </div> -->
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="semestre">Semestre(*)</label>
            <div class="col-sm-8">
                <select name="semestre" id="semestre" class="form-control">
                    <option value="">[--SELECIONE SEMESTRE--]</option>
                    <option>I</option>
                    <option>II</option>
                    <option>III</option>
                    <option>IV</option>
                    <option>V</option>
                    <option>VI</option>
                </select>
            </div>
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
