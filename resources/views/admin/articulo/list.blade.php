<div class="card">
    <div class="card-header">
        <h3 class="card-title">Resultado de búsqueda</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                
               
                <th>Cuenta</th>
                <!-- <th>Codigo de Barra</th> -->
                <th>Fecha de Entrada</th>
                <th>documento</th>
                <th>Numero de Comprobante</th>
                <th>Procedencia</th>
                <th>Forma de Ingreso</th>
                <th>Nombre de articulo</th>
                <th>Nombre de categoria</th>
                <th>Stock</th>
                <th>Caracteristica</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Numero de Serie</th>
                <th>Color</th>
                <th>Precio</th>
                <th style="max-width: 200px">Opciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listado as $item)
                    <tr>
                        
            
                        <td>{{ $item->cuenta }}</td>
                        <!-- <td>{{ $item->cod_barra }}</td> -->
                        <td>{{ $item->fecha_entrada }}</td>
                        <td>{{ $item->documento }}</td>
                        <td>{{ $item->nro_comprobante }}</td>
                        <td>{{ $item->procedencia }}</td>
                        <td>{{ $item->forma_ingreso }}</td>
                        <td>{{ $item->nombre_articulo }}</td>
                        <td>{{ $item->nombre_categoria }}</td>
                        <td>{{ $item->stock}}</td>
                        <td>{{ $item->caracteristica }}</td>
                        <td>{{ $item->marca }}</td>
                        <td>{{ $item->modelo }}</td>
                        <td>{{ $item->nro_serie }}</td>
                        <td>{{ $item->color }}</td>
                        <td>{{ $item->precio }}</td>
                       
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
        // "paging": true,
        // "lengthChange": false,
        // "searching": false,
        // "ordering": true,
        // "info": true,
        // "autoWidth": false,
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
        },
        "responsive": true,
        "columnDefs": [{
            targets: 1,
            orderable: false,
            searchable: false
        }]
    });
</script>
