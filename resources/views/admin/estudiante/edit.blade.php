<div class="modal-header">
    <h4 class="modal-title">Editar estudiante</h4>
</div>
<form action="" id="formulario-editar" autocomplete="off">
    @method('PUT')
    <div class="modal-body">
        <!-- <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="programa_id">programa</label>
            <div class="col-sm-8">
                <select name="programa_id" id="programa_id" class="form-control">
                    <option value="">[--SELECCIONE--]</option>

                    @foreach ($programa_estudiante as $programa)
                    <option value="{{$programa->nombre_programa}}">{{$programa->nombre_programa}}</option>
                    @endforeach
                </select>
            </div>
        </div> -->


        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="programa_id">Nombre de Programa(*)</label>
            <div class="col-sm-8">
                <input type="text" name="programa_id" id="programa_id" class="form-control" placeholder="Ingrese Nombre de Programa" value="{{$item->programa_id}}" />
            </div>
        </div>


        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="nombre">Nombre(*)</label>
            <div class="col-sm-8">
                <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingrese Nombres" value="{{ $item->nombre }}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="apellidos">Apellidos(*)</label>
            <div class="col-sm-8">
                <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Ingrese Apellidos" value="{{ $item->apellidos }}" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="nro_celular">Celular</label>
            <div class="col-sm-8">
                <input type="text" name="nro_celular" id="nro_celular" class="form-control" placeholder="Ingrese Numero de Celular" value="{{ $item->nro_celular }}"/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="dni">dni(*)</label>
            <div class="col-sm-8">
                <input type="text" name="dni" id="dni" class="form-control" placeholder="Ingrese Numero de DNI" value="{{ $item->dni }}" />
            </div>
        </div>
        <!-- <div class="form-group row">
            <label class="col-sm-4 col-form-label" for="semestre">Semestre</label>
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
    </div> -->
    <div class="form-group row">
            <label class="col-sm-6 col-form-label" for="semestre">Semestre(*)</label>
            <div class="col-sm-8">
                <input type="text" name="semestre" id="semestre" class="form-control" placeholder="Ingrese Semestre" value="{{ $item->semestre }}" />
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
