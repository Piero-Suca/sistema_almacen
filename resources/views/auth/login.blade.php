<!doctype html>
<html lang="es">
    <head>
        
        <meta charset="utf-8">
        
        <title> SISGA LOGIN </title>    
        
   
     
        <link rel="stylesheet" href="../resources/views/dist/css/adminlte.css">
        
        <style type="text/css">
            
        </style>
        
        <script type="text/javascript">
        
        </script>
        
    </head>
    
    <body>
    
        <div id="f1">
            
            <div id="contenedorcentrado">
                <div id="login">
                    <form method="POST" action="{{ route('login') }}">
                    @csrf
                        <label for="email" :value="__('Correo Electronico')">Usuario</label>
                        <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        <!--contraseña-->
                        <label for="password" :value="__('Contraseña')">Contraseña</label>
                        <input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <!--Boton-->
                        <x-primary-button class="ml-3">
                            {{ __('Ingresar') }}
                        </x-primary-button>
                    </form>
                    
                </div>
                <div id="derecho">
                    <div class="titulo">
                        Bienvenido al sistema web SISGA
						<a><img src="../img/logo.png" width="176" height="176"></a>
                    </div>
                    <hr>
                    <div class="pie-form">
                        <a>Sigamos triunfando</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>