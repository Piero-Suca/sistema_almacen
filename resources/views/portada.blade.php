<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portada</title>
</head>

<body>
    <h1>Esta es la pagina de portada</h1>
    {{ $nombre_usuario }}
    @if ($edad >= 18)
        {{ 'Eres mayor de edad' }}
    @endif
    <ul>
        <li>Item 1</li>
        <li>Item 2</li>
        <li>Item 3</li>
    </ul>
</body>

</html>
