<?php

namespace App\Http\Controllers;

use App\Models\docente;
use App\Models\especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
//uso de la libreria
use Barryvdh\DomPDF\Facade\Pdf;

class docenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.docente.index");
    }
     //crear metodo pdf
     public function pdf(){
        $docente = docente::all();
        $pdf = Pdf::loadView('admin.docente.pdf', compact('docente'));
        return $pdf->stream();
    }
    public function search(Request $request)
    {
        // recuerar el parametro busqueda
        $busqueda = $request->get('busqueda', '');

        // realizar la busqueda
        // ORM -> ELOQUENT
        // select id, nombre_docente from tipocurso WHERE nombre_docente LIKE '%diplomado%' AND deleted_at IS NULL
        $listado = docente::join('especialidad', 'docente.nombre_especialidad', '=', 'especialidad.nombre_especialidad')
        ->where('docente.nombre_docente','LIKE', '%' . $busqueda . '%')
        ->select('docente.id','docente.cod_docente','docente.nombre_docente','docente.apellidos','docente.nro_celular','docente.nombre_especialidad', 'especialidad.nombre_especialidad AS nombre_especialidad')
        ->get();
        return view("admin.docente.list", [
            "listado" => $listado
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $especialidades = especialidad::orderBy('nombre_especialidad', 'ASC')->select('id', 'nombre_especialidad')->get();

    return view("admin.docente.create", [
        'especialidades' => $especialidades,
        
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // aplicar validacion de nuestros datos
        $validator = Validator::make($request->all(), [
            'nombre_docente' => 'required|string|min:1|max:220',
            'cod_docente' => 'required|string|min:1|max:12',
            'apellidos' => 'required|string|min:1|max:220',
            'nro_celular' => 'required|string|min:9|max:12',
            'nombre_especialidad' => 'required|string|min:1|max:2200'
            
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
            
            $nombre_docente = $request->get('nombre_docente');
            $cod_docente = $request->get('cod_docente');
            $apellidos = $request->get('apellidos');
            $nro_celular = $request->get('nro_celular');
            $nombre_especialidad = $request->get('nombre_especialidad');
           
            // crear un nuevo registro en la BD
            // INSERT INTO tipocurso (nombre_docentes, activo) VALUES ($nombre_docente, 1)
            $docente = new docente();
            $docente->nombre_docente = $nombre_docente;
            $docente->cod_docente = $cod_docente;
            $docente->apellidos = $apellidos;
            $docente->nro_celular = $nro_celular;
            $docente->nombre_especialidad = $nombre_especialidad;
            
            $docente ->save(); // encargado de aplicar el insert into

            $data = [
                'message' => 'Registrado correctamente'
            ];
            return response()->json($data, 201);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = [
                'message' => 'Error al registrar el docente. Contactarse con el area de soporte'
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    try {
        $docente = docente::find($id);
        $especialidad_docente = especialidad::orderBy('nombre_especialidad', 'ASC')->select('id', 'nombre_especialidad')->get();

        return view('admin.docente.edit', [
            "item" => $docente,
            "especialidad_docente" => $especialidad_docente,
        ]);
    } catch (\Throwable $error) {
        Log::error($error->getMessage());
        $data = [
            'message' => 'ERROR AL REGISTRAR EL docente. CONTACTARSE CON EL AREA DE SOPORTE'
        ];
        return response()->json($data, 500);
    }
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $cod_docente)
    {
        $validator = Validator::make($request->all(), [
            'nombre_docente' => 'required|string|min:3|max:120'
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
            $docente = docente::find($cod_docente);
            $docente->nombre_docente = $request->get('nombre_docente');
            $docente->cod_docente = $request->get('cod_docente');
            $docente->apellidos = $request->get('apellidos');
            $docente->nro_celular = $request->get('nro_celular');
            $docente->nombre_especialidad = $request->get('nombre_especialidad');
            
            $docente->save(); // aplicando el UPDATE tipocurso SET nombre_docente = $reques WHERE id = $id
            $data = ['message' => 'Actualizado correctamente'];
            return response()->json($data, 200);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());
            $data = [
                'message' => 'Error al actualizar el tipo de curso'
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $cod_docente)
    {
        try {
            $docente = docente::find($cod_docente);
            $docente->delete(); // DELETE FROM tipocurso WHERE id =$id
            // UPDATE tipocurso SET deleted_at = TIMESTAMP where id = $id

            $data = ['message' => 'Eliminado correctamente'];

            return response()->json($data, 200);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = ['message' => 'Error al eliminar docente'];

            return response()->json($data, 500);
        }
    }
}
