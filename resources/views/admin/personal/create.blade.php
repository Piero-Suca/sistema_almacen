<div class="modal-header">
    <h4 class="modal-title">Registrar personal</h4>
</div>
<form action="" id="formulario-crear" autocomplete="off">
    <div class="modal-body">
    
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="cod_personal">Codigo de Personal(*)</label>
            <div class="col-sm-8">
                <input type="text" name="cod_personal" id="cod_personal" class="form-control" placeholder="Ingrese el DNI del Personal"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nombres">Nombres(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nombres" id="nombres" class="form-control" placeholder="Ingrese Nombres"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="apellidos">Apellidos(*)</label>
            <div class="col-sm-8">
                <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Ingrese Apellidos"/>
            </div>
    </div>
    <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nro_celular">Numero de celular</label>
            <div class="col-sm-8">
                <input type="text" name="nro_celular" id="nro_celular" class="form-control" placeholder="Ingrese Numero de Celular"/>
            </div>
    </div>
    <div class="modal-body">
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="nombre_oficina">Tipo oficina(*)</label>
            <div class="col-sm-8">
                <select name="nombre_oficina" id="nombre_oficina" class="form-control" >
                    <option value="">[--SELECCIONE--]</option>
                    @foreach ($oficinas as $oficina)
                        <option value="{{$oficina->nombre_oficina }}">{{ $oficina->nombre_oficina}}</option>
                    @endforeach
                </select>
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
