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
            <label class="col-sm-6 col-form-label" for="cod_docente">Codigo de Docente(*)</label>
            <div class="col-sm-8">
                <input type="text" name="cod_docente" id="cod_docente" class="form-control" placeholder="Ingrese el DNI de Docente" value="{{ $item->cod_docente}}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="nombre_docente">Nombre de docente(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nombre_docente" id="nombre_docente" class="form-control" placeholder="Ingrese Nombre de Docente" value="{{ $item->nombre_docente}}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="apellidos">Apellidos(*)</label>
            <div class="col-sm-8">
                <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Ingrese los Apellidos" value="{{ $item->apellidos}}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="nro_celular">Numero de celular(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nro_celular" id="nro_celular" class="form-control" placeholder="Ingrese el Numero de Celular" value="{{ $item->nro_celular}}" />
            </div>
        </div>
        
        <!-- <div class="modal-body">
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="nombre_especialidad">Tipo especialidad</label>
            <div class="col-sm-8">
                <select name="nombre_especialidad" id="nombre_especialidad" class="form-control" >
                    <option value="">[--SELECCIONE--]</option>
                    @foreach ($especialidad_docente as $especialidad)
                        <option value="{{$especialidad->nombre_especialidad }}">{{ $especialidad->nombre_especialidad}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
    </div> -->


    <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="nombre_especialidad">Tipo de Especialidad(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nombre_especialidad" id="nombre_especialidad" class="form-control" placeholder="Ingrese el Numero de Celular" value="{{ $item->nombre_especialidad}}" />
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
