<div class="card">
    <div class="card-header">
        <h3 class="card-title">Resultado de búsqueda</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <table id="example2" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th> 
                </tr>
            </thead>
            <tbody>
            @foreach ($listado as $item)
                    <tr>
                       
                        <td>{{ $item->name}}</td>
                        <td>{{ $item->email}}</td>
                        
                        
                        
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
