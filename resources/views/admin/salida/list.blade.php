<div class="card">
    <div class="card-header">
        <h3 class="card-title">Resultado de búsqueda</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Codigo de Persona</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Nombre de Articulo</th>
                    <th>Cantidad</th>
                    <th>Unidad de Medida</th>
                    <th>Fecha de salida</th>
                    <th>Tipo de Salida</th>
                    <th>Fecha de retorno</th>
                    <th>Observaciones</th>
                    <th>Devoluciones</th>
                    <th>Opciones</th>
                    
                   
                </tr>
            </thead>
            <tbody>
            @foreach ($listado as $item)
                    <tr class="{{$item->devoluciones ==='NO DEVUELTO' ? 'table-danger' : ($item->devoluciones=== 'DEVUELTO' ? 'table-success':'') }}">
                        <td>{{ $item->cod_persona}}</td>
                        <td>{{ $item->nombres}}</td>
                        <td>{{ $item->apellidos}}</td>
                        <td>{{ $item->nombre_articulo}}</td>
                        <td>{{ $item->cantidad}}</td>
                        <td>{{ $item->unidad_medida}}</td>
                        <td>{{ $item->fecha_salida}}</td>
                        <td>{{ $item->tipo_salida}}</td>
                        <td>{{ $item->fecha_retorno}}</td>
                        <td>{{ $item->observaciones}}</td>
                        <td>{{ $item->devoluciones}}</td>
                        
                        <td class="text-center">
                            <button onclick="modalEditar({{ $item->id }})" class="btn btn-warning">Editar</button>
                            <button onclick="confirmarEliminar({{ $item->id }})"
                                class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
<script>
    $('#example2').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        "responsive": true,
        "columnDefs": [{
            targets: 3,
            orderable: false,
            searchable: false
        }]
    });
</script>
