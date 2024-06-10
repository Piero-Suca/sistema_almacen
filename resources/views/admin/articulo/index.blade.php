@extends('layouts.admin')

@section('titulo')
    articulos | Laravel
@endsection

@section('contenido')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2" >
                    <div class="col-sm-6" >
                        <h1 class="m-0">Articulos</h1>
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
                                <h5 class="m-0">Búsqueda de articulos</h5>
                            </div>
                            <div class="card-body">
                                <form class="form-inline" id="formulario-busqueda">
                                    <label class="my-1 mr-2" for="busqueda">Artículo</label>
                                    <input type="text" class="form-control my-1 mr-sm-2" id="busqueda" name="busqueda">
                                    <button type="submit" class="btn btn-primary my-1">Buscar</button>
                                    <button onclick="modalCrear()" type="button" class="btn btn-success my-1 mx-1">Nuevo</button>
                                    <!-- <a href="{{route('articulo.pdf')}}" class="btn btn-danger" target="_blank">Exportar PDF</a> -->
                                    <a href="{{route('exportar.articulo')}}"class="btn btn-danger my-1 mx-1"> Exportar Excel</a>
                                    <!-- <a href="route{{('articulo.excel') }}"class="bg-gray-700 "> CSV</a> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12" id="listado">
                        <!-- Aquí se mostrará el listado de articulos -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modales')
    <div class="modal fade" id="modal-agregar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-agregar-contenido">
                <!-- Contenido del modal para agregar -->
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-editar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-editar-contenido">
                <!-- Contenido del modal para editar -->
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        document.getElementById("formulario-busqueda").addEventListener("submit", function(evento) {
            evento.preventDefault();
            search();
        });

        document.addEventListener("DOMContentLoaded", function() {
            search();
        });

          // realizar la peticion ajax y recibir el resultado
          function search() {
            const busqueda = document.getElementById("busqueda").value;
            const ruta = route('articulo.search');

            axios.get(ruta, {
                    params: {
                        "busqueda": busqueda
                    }
                }).then(function(response) {
                    // cuando la peticion indicado que todo esta OK: 100, 200, 300
                    const tabla_html = response.data;
                    $("#listado").html(tabla_html);
                })
                .catch(function(error) {
                    // cuando ha ocurrido un error: 400 o 500
                })

        }

        function modalCrear() {
            const ruta = route("articulo.create");

            axios.get(ruta)
                .then(function(respuesta) {
                    $('#modal-agregar-contenido').html(respuesta.data);
                    $('#modal-agregar').modal('show');
                }).catch(function() {

                })

        }

        function guardar() {
            const ruta = route('articulo.store');
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
            // /admin/tipocurso/8/edit
            const ruta = route('articulo.edit', [id]);

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
            const ruta = route('articulo.update', [id]);
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
                    const ruta = route('articulo.destroy', [id]);
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
