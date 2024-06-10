@extends('layouts.admin')

@section('titulo')
    salida | Laravel
@endsection

@section('contenido')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">salida</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h5 class="m-0">Búsqueda de salida</h5>
                            </div>
                            <div class="card-body">

                            

    <form class="form-inline" id="formulario-busqueda" method="GET">
<div class="form-group mr-2">
    <label class="my-1 mr-2" for="busqueda">Nombre</label>
    <input type="text" class="form-control my-1 mr-sm-2" id="busqueda" name="busqueda" value="{{ request('busqueda') }}">
</div>
    <!-- <label for="fecha_inicio" class="m-0">FECHA DE SALIDA</label>
    <input type="date" class="form-control my-1 mr-sm-2" id="fecha_inicio" name="fecha_inicio" value="{{ request('fecha_inicio') }}">
    
    <label for="fecha_fin" class="m-0">FECHA DE RETORNO</label>
    <input type="date" class="form-control my-1 mr-sm-2" id="fecha_fin" name="fecha_fin" value="{{ request('fecha_fin') }}"> -->

    <button type="submit" class="btn btn-primary my-1">Buscar</button>
    <button onclick="modalCrear()" type="button" class="btn btn-success my-1 mx-1">Nuevo</button>
    <a href="{{route('salida.pdf')}}" class="btn btn-danger" target="_blank">Exportar PDF</a>
</form>


                
<form class="form-inline" id="formulario-busqueda">
<label for="fecha_inicio" class="m-0">FECHA DE SALIDA</label>
    <input type="date" class="form-control my-1 mr-sm-2" id="fecha_inicio" name="fecha_inicio" value="{{ request('fecha_inicio') }}">
    
    <label for="fecha_fin" class="m-0">FECHA DE RETORNO</label>
    <input type="date" class="form-control my-1 mr-sm-2" id="fecha_fin" name="fecha_fin" value="{{ request('fecha_fin') }}">

    <button type="submit" class="btn btn-primary my-1">Buscar</button>
    <a href="{{route('salida.rfechas')}}" class="btn btn-danger" target="_blank">Exportar PDF</a>
</form>


<form action="{{ route('export') }}" method="GET">
    <label for="fecha_salida">fecha inicio</label>
    <input type="date" id="fecha_salida" name="fecha_salida" required>

    <label for="fecha_retorno">fecha fin</label>
    <input type="date" id="fecha_retorno" name="fecha_retorno" required>

    <button type="submit">Export</button>
    
</form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="listado">
                        <!-- Aquí se mostrará el listado de salidas -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modales')
    <!-- Modal para agregar -->
    <div class="modal fade" id="modal-agregar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-agregar-contenido">
                <!-- Contenido del modal para agregar -->
            </div>
        </div>
    </div>

    <!-- Modal para editar -->
    <div class="modal fade" id="modal-editar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-editar-contenido">
                <!-- Contenido del modal para editar -->
            </div>
        </div>
    </div>
@endsection

@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.3/jspdf.umd.min.js"></script>
<script src="generar_pdf.js"></script>
    <script>
        // Tu código JavaScript

        document.getElementById("formulario-busqueda").addEventListener("submit", function(evento) {
            evento.preventDefault();
            search();
        });

        document.addEventListener("DOMContentLoaded", function() {
            search();
        });

        function generarPDF() {
    // Obtener los valores del formulario
    var fechaInicio = document.getElementById('fecha_inicio').value;
    var fechaFin = document.getElementById('fecha_fin').value;

    // Crear un formulario invisible para enviar los datos al script PHP
    var form = document.createElement('form');
    form.setAttribute('method', 'post');
    form.setAttribute('action', 'generar_pdf.php');
    form.setAttribute('target', '_blank'); // Abrir el PDF en una nueva ventana

    // Agregar campos al formulario
    var fechaInicioField = document.createElement('input');
    fechaInicioField.setAttribute('type', 'hidden');
    fechaInicioField.setAttribute('name', 'fecha_inicio');
    fechaInicioField.setAttribute('value', fechaInicio);
    form.appendChild(fechaInicioField);

    var fechaFinField = document.createElement('input');
    fechaFinField.setAttribute('type', 'hidden');
    fechaFinField.setAttribute('name', 'fecha_fin');
    fechaFinField.setAttribute('value', fechaFin);
    form.appendChild(fechaFinField);

    // Agregar el formulario al cuerpo del documento y enviarlo
    document.body.appendChild(form);
    form.submit();
}

        function search() {
    const busqueda = document.getElementById("busqueda").value;
    const fecha_inicio = document.getElementById("fecha_inicio").value;
    const fecha_fin = document.getElementById("fecha_fin").value;
    
    const ruta = "{{ route('salida.search') }}";

    axios.get(ruta, {
        params: {
            "busqueda": busqueda,
            "fecha_inicio": fecha_inicio,
            "fecha_fin": fecha_fin
        }
    }).then(function(response) {
        // cuando la peticion indicado que todo esta OK: 100, 200, 300
        const tabla_html = response.data;
        $("#listado").html(tabla_html);
    }).catch(function(error) {
        // cuando ha ocurrido un error: 400 o 500
        console.error(error);
    });
}

        function modalCrear() {
            const ruta = route("salida.create");

            axios.get(ruta)
                .then(function(respuesta) {
                    $('#modal-agregar-contenido').html(respuesta.data);
                    $('#modal-agregar').modal('show');
                }).catch(function() {

                })

        }

        function guardar() {
            const ruta = route('salida.store');
            const form = document.getElementById('formulario-crear');
            const data = new FormData(form);

            axios.post(ruta, data)
                .then(function(respuesta) {
                    // 100,200,300
                    const mensaje = respuesta.data.message;
                    toastr.success(mensaje);
                    $('#modal-agregar').modal('hide');
                    search();
                })
                .catch(function(error) {
                    // 2 tipos
                    // TIPO 1: 400,500
                    if (error.response) {
                        toastr.error(error.response.data.message, "Error del sistema");
                        if (error.response.status === 422) {
                            // entidad improcesable: cuando hay error en la validacion de los datos
                            // funcion que genere los mensajes de error
                            mostrarErrores('formulario-crear', error.response.data.errors);
                        }
                    } else {
                        toastr.error(error);
                    }
                    // TIPO 2: cuando se comete un error dentro del METODO THEN
                });
        }


        function modalEditar(id) {
            const ruta = route('salida.edit', [id]);

            axios.get(ruta)
                .then(function(respuesta) {
                    $("#modal-editar-contenido").html(respuesta.data);
                    $("#modal-editar").modal('show');
                })
                .catch(function(error) {
                    if (error.response) {
                        toastr.error(error.response.data.message, "Error del sistema");
                    } else {
                        toastr.error(error);
                    }
                });


        }

        function actualizar(id) {
            const ruta = route('salida.update', [id]);
            const form = document.getElementById("formulario-editar");
            const data = new FormData(form);

            axios.post(ruta, data)
                .then(function(respuesta) {
                    toastr.success(respuesta.data.message);
                    $('#modal-editar').modal('hide');
                    search();
                })
                .catch(function(error) {
                    if (error.response) {
                        toastr.error(error.response.data.message, 'Error en el sistema');
                        if (error.response.status === 422) {
                            mostrarErrores('formulario-editar', error.response.data.errors);
                        }
                    } else {
                        toastr.error(error);
                    }

                });

        }

        function confirmarEliminar(id) {
            Swal.fire({
                title: '¿Está seguro?',
                text: "Este cambio no se puede deshacer!",
                icon: 'error',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<i class="far fa-trash-alt"></i> Si, eliminar!',
                cancelButtonText: '<i class="far fa-window-close"></i> Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const ruta = route('salida.destroy', [id]);
                    const data = new FormData();
                    data.append('_method', 'DELETE');

                    axios.post(ruta, data)
                        .then(function(respuesta) {
                            toastr.success(respuesta.data.message);
                            search();
                        })
                        .catch(function(error) {
                            if (error.response) {
                                toastr.error(error.response.data.message, "Error del sistema");
                            } else {
                                toastr.error(error);
                            }
                        });
                }
            });
        }
    </script>
@endsection
<style> 
    .Navbar{ 
        background: #B8742D; 
    } 
    </style>