<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Salidas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Reporte de Salidas</h1>
    <table>
        <thead>
            <tr>
                <th>Fecha de Salida</th>
                <th>Fecha Retorno</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fechas as $fechas)
            <tr>
                <td>{{ $fechas->fecha_salida }}</td>
                <td>{{ $fechas->fecha_retorno }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
