<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Articulo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        header img {
            width: 110px;
            height: 50px;
            vertical-align: middle;
        }
        header h3 {
            display: inline;
            margin-left: 10px;
            vertical-align: middle;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            border: 1px solid black; 
            
        }
        .table2 {
            border-collapse: collapse;
            width: 90%;
            margin: 0 auto;
            border: none; 
            
        }
        .th2, .td2 {
            border: none;
            padding: 2px;
            text-align: center;
        }
        th, td {
            border: 1px solid black;
            padding: 2px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-center {
            text-align: center;
        }
        footer {
            text-align: center;
            margin-top: 50px;
        }
        /* Nuevos estilos */
        .container {
            position: relative;
        }
        .footer-text {
            position: fixed;
            bottom: 20px; /* Ajusta la posición vertical según lo necesites */
            width: 100%;
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <table class="table2">
            <tr class="tr2">
                <td class="td2"><img src="../img/logosalle5.png" alt="La Salle Logo" width="110px" height="50"></td>
                <td class="td2"><h3>Instituto de Educación Superior Tecnológico Público La Salle</h3></td>
            </tr>
        </table>
         <hr>
    </header>
    <section>
        <div class="container">
            <div class="card-body">
                <h2 style="text-align: center;">Lista de Productos</h2>
                <table>            
                    <thead>
                    <tr>
                   <th>Nombre de articulo</th>
                   <th>Stock</th>
                   <th>Unidad de Medida</th>
                   <th>Marca</th>
                   <th>Modelo</th>
                   <th>Numero de Serie</th>
                   <th>Estado</th>
                   <th>Fecha de Entrada</th>  
               </tr>
           </thead>
           <tbody>
               @foreach ($articulos as $item)
                   <tr>
                       <td>{{ $item->nombre_articulo }}</td>
                       <td>{{ $item->stock }}</td>
                       <td>{{ $item->unidad_medida }}</td>
                       <td>{{ $item->marca }}</td>
                       <td>{{ $item->modelo }}</td>
                       <td>{{ $item->nro_serie }}</td>
                       <td>{{ $item->estado }}</td>
                       <td>{{ $item->fecha_entrada }}</td>
                   </tr>
               @endforeach
                    </tbody>
                </table>
            </div>
            <div class="footer-text">
                <hr>
                <p>Responsable de Sistema de Información SISGA 2023 &copy;</p>
            </div>
        </div>
    </section>
</body>
</html>