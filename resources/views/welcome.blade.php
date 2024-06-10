<!DOCTYPE html> 
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> 
<head> 
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Laravel</title> 
 
    <style> 
        body { 
            font-family: Arial, sans-serif; 
            background-color: #012238; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            margin: 0; 
            color: #fff; 
        } 
 
        .container { 
            max-width: 800px; 
            padding: 20px; 
            text-align: center; 
        } 
 
        .top-right-links { 
            position: fixed; 
            top: 0; 
            right: 0; 
            padding: 20px; 
            text-align: right; 
            z-index: 1000; 
        } 
 
        .login-button, .register-button { /* Aplicar el mismo estilo a ambos botones */ 
            display: inline-block; 
            padding: 10px 20px; 
            font-size: 20px; 
            font-weight: 600; 
            color: #49bbcfee; 
            background-color: transparent; 
            border: 4px solid #49bbcfee; 
            border-radius: 10px; 
            cursor: pointer; 
            transition: background-color 0.3s, color 0.3s; 
            margin-right: 10px; /* Agregar margen derecho para separar los botones */ 
        } 
 
        .login-button:hover, .register-button:hover { 
            background-color: #007bff; 
            color: #fff; 
        } 
 
        .letter-box { 
            display: inline-block; 
            width: 80px; 
            height: 80px; 
            background-color: #007bff; 
            color: #fff; 
            border-radius: 10px; 
            margin: 8px; 
            line-height: 80px; 
            font-size: 60px; 
            text-align: center; 
            box-shadow: 0 0 0 4px white; 
        } 
 
        .letter-box-container { 
            display: inline-block; 
            margin-top: 20px; 
        } 
 
        .logo-image { 
            width: 600px; 
            height: auto; 
        } 
    </style> 
</head> 
<body class="antialiased"> 
    <div class="container"> 
        @if (Route::has('login')) 
            <div class="top-right-links"> 
                @auth 
                    {{-- <a href="{{ url('/dashboard') }}" class="dashboard-link">Dashboard</a> --}} 
                @else 
                    <button onclick="window.location='{{ route('login') }}'" class="login-button">Ingresar</button> 
                    {{-- Utilizar el mismo estilo para el botón de registro --}} 
                    {{-- @if (Route::has('register')) 
                        <button onclick="window.location='{{ route('register') }}'" class="register-button">Registrar</button> 
                    @endif --}} 
                @endauth 
            </div> 
        @endif 
 
        <div> 
            <center>  
                <img src="../img/logosalle5.png" class="logo-image"> 
            </center> 
        </div> 
 
        <div class="content-wrapper"> 
            <div class="letter-box-container"> 
                <div class="letter-box">S</div> 
                <div class="letter-box">I</div> 
                <div class="letter-box">S</div> 
                <div class="letter-box">G</div> 
                <div class="letter-box">A</div> 
            </div> 
        </div> 
    </div> 
</body> 
</html>