<?php

namespace App\Http\Controllers;

use App\Models\especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
//uso de la libreria
use Barryvdh\DomPDF\Facade\Pdf;

class especialidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.especialidad.index");
    }
     //crear metodo pdf
     public function pdf(){
        $especialidad = especialidad::all();
        $pdf = Pdf::loadView('admin.especialidad.pdf', compact('especialidad'));
        return $pdf->stream();
    }
    public function search(Request $request)
    {

        $busqueda = $request->get('busqueda', '');
        $listado = especialidad::where('nombre_especialidad', 'LIKE', '%' . $busqueda . '%')
        ->select('id','cod_especialidad','nombre_especialidad')
        ->get();
        return view("admin.especialidad.list", [
            "listado" => $listado
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.especialidad.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // aplicar validacion de nuestros datos
        $validator = Validator::make($request->all(), [
            'cod_especialidad' => 'required|string|min:1|max:20',
            'nombre_especialidad' => 'required|string|min:1|max:220',
            
            
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
            
            $cod_especialidad = $request->get('cod_especialidad');
            $nombre_especialidad = $request->get('nombre_especialidad');
            $especialidad = new especialidad();
            $especialidad->cod_especialidad = $cod_especialidad;
            $especialidad->nombre_especialidad = $nombre_especialidad;
            $especialidad ->save();
            $data = [
                'message' => 'Registrado correctamente'
            ];
            return response()->json($data, 201);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = [
                'message' => 'Error al registrar el especialidad. Contactarse con el area de soporte'
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $cod_especialidad)
    {
        try {
            // select * from tipocurso WHERE id = $id
            $especialidad = especialidad::find($cod_especialidad);
            // $tipocurso = Tipocurso::where('id', '=', $id)->first();
            return view('admin.especialidad.edit', ["item" => $especialidad]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $cod_especialidad)
    {
        $validator = Validator::make($request->all(), [
            'cod_especialidad' => 'required|string|min:1|max:50',
            'nombre_especialidad' => 'required|string|min:1|max:50',
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
            $especialidad = especialidad::find($cod_especialidad);
            $especialidad->cod_especialidad = $request->get('cod_especialidad');
            $especialidad->nombre_especialidad = $request->get('nombre_especialidad');
            
            
            $especialidad->save(); // aplicando el UPDATE tipocurso SET nombre_especialidad = $reques WHERE id = $id
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
    public function destroy(string $cod_especialidad)
    {
        try {
            $especialidad = especialidad::find($cod_especialidad);
            $especialidad->delete();
            $data = ['message' => 'Eliminado correctamente'];
            return response()->json($data, 200);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = ['message' => 'Error al eliminar especialidad'];

            return response()->json($data, 500);
        }
    }
}
