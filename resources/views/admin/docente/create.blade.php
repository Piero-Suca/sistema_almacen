<div class="modal-header">
    <h4 class="modal-title">Registrar docente</h4>
</div>
<form action="" id="formulario-crear" autocomplete="off">
    <div class="modal-body">
        
    
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="cod_docente">Codigo de Docente(*)</label>
            <div class="col-sm-8">
                <input type="text" name="cod_docente" id="cod_docente" class="form-control" placeholder="Ingrese DNI del Docente"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombre_docente">Nombre de Docente(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nombre_docente" id="nombre_docente" class="form-control" placeholder="Ingrese Nombre del Docente"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="apellidos">Apellidos(*)</label>
            <div class="col-sm-8">
                <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Ingrese Apellidos"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nro_celular">Numero de Celular(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nro_celular" id="nro_celular" class="form-control" placeholder="Ingrese Numero de Celular"/>
            </div>
    </div>


    <div class="modal-body">
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="nombre_especialidad">Tipo especialidad(*)</label>
            <div class="col-sm-8">
                <select name="nombre_especialidad" id="nombre_especialidad" class="form-control" >
                    <option value="">[--SELECCIONE--]</option>
                    @foreach ($especialidades as $especialidad)
                        <option value="{{$especialidad->nombre_especialidad }}">{{ $especialidad->nombre_especialidad}}</option>
                    @endforeach
                </select>
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
