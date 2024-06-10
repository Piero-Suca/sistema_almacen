<?php

namespace App\Http\Controllers;

use App\Models\programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
//uso de la libreria
use Barryvdh\DomPDF\Facade\Pdf;

class programaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.programa.index");
    }
     //crear metodo pdf
     public function pdf(){
        $programas = programa::all();
        $pdf = Pdf::loadView('admin.programa.pdf', compact('programas'));
        return $pdf->stream();
    }
    public function search(Request $request)
    {
        // recuerar el parametro busqueda
        $busqueda = $request->get('busqueda', '');

        // realizar la busqueda
        // ORM -> ELOQUENT
        // select id, nombre_programa_programa from tipocurso WHERE nombre_programa_programa LIKE '%diplomado%' AND deleted_at IS NULL
        $listado = programa::where('nombre_programa', 'LIKE', '%' . $busqueda . '%')
        ->select('id','cod_programa','nombre_programa','anio_creacion')
        ->get();
        return view("admin.programa.list", [
            "listado" => $listado
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.programa.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // aplicar validacion de nuestros datos
        $validator = Validator::make($request->all(), [
            'nombre_programa' => 'required|string|min:1|max:220',
            'cod_programa' => 'required|string|min:1|max:20',
            'anio_creacion' => 'required|int|min:1|max:4',
        ]);

        if ($validator->fails()) {
            // retornar la lista de errores JSON
            $errors = $validator->errors();

            $data = [
                'message' => 'Error en la validacion de los datos',
                'errors' => $errors
            ];

            return response()->json($data, 422);
        }

        try {
            
            $nombre_programa = $request->get('nombre_programa');
            $cod_programa = $request->get('cod_programa');
            $anio_creacion = $request->get('anio_creacion');
            // crear un nuevo registro en la BD
            // INSERT INTO tipocurso (nombre_programa_programas, activo) VALUES ($nombre_programa_programa, 1)
            $programa = new programa();
            $programa->nombre_programa = $nombre_programa;
            $programa->cod_programa = $cod_programa;
            $programa->anio_creacion = $anio_creacion;
            $programa ->save(); // encargado de aplicar el insert into

            $data = [
                'message' => 'Registrado correctamente'
            ];
            return response()->json($data, 201);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = [
                'message' => 'Error al registrar el programa. Contactarse con el area de soporte'
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $cod_programa)
    {
        try {
            // select * from tipocurso WHERE id = $id
            $programa = programa::find($cod_programa);
            // $tipocurso = Tipocurso::where('id', '=', $id)->first();
            return view('admin.programa.edit', ["item" => $programa]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $cod_programa)
    {
        $validator = Validator::make($request->all(), [
            'nombre_programa' => 'required|string|min:1|max:150',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $data = [
                'errors' => $errors,
                'message' => 'Error al validar los datos'
            ];

            return response()->json($data, 422);
        }

        try {
            $programa = programa::find($cod_programa);
            $programa->nombre_programa = $request->get('nombre_programa');
            $programa->cod_programa = $request->get('cod_programa');
            $programa->anio_creacion = $request->get('anio_creacion');
            $programa->save(); // aplicando el UPDATE tipocurso SET nombre_programa_programa = $reques WHERE id = $id
            $data = ['message' => 'Actualizado correctamente'];
            return response()->json($data, 200);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());
            $data = [
                'message' => 'Error al actualizar el programa'
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $cod_programa)
    {
        try {
            $programa = programa::find($cod_programa);
            $programa->delete(); // DELETE FROM tipocurso WHERE id =$id
            // UPDATE tipocurso SET deleted_at = TIMESTAMP where id = $id

            $data = ['message' => 'Eliminado correctamente'];

            return response()->json($data, 200);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = ['message' => 'Error al eliminar programa'];

            return response()->json($data, 500);
        }
    }
}