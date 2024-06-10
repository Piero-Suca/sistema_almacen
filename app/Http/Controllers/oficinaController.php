<?php

namespace App\Http\Controllers;

use App\Models\oficina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
//uso de la libreria
use Barryvdh\DomPDF\Facade\Pdf;

class oficinaController extends Controller
{

    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.oficina.index");
    }
     //crear metodo pdf
     public function pdf(){
        $oficinas = oficina::all();
        $pdf = Pdf::loadView('admin.oficina.pdf', compact('oficinas'));
        return $pdf->stream();
    }
    public function search(Request $request)
    {
        // recuerar el parametro busqueda
        $busqueda = $request->get('busqueda', '');

        // realizar la busqueda
        // ORM -> ELOQUENT
        // select id, nombre_oficina from tipocurso WHERE nombre_oficina LIKE '%diplomado%' AND deleted_at IS NULL
        $listado = oficina::where('nombre_oficina', 'LIKE', '%' . $busqueda . '%')->select('id','cod_oficina','nombre_oficina')->get();
        return view("admin.oficina.list", [
            "listado" => $listado
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.oficina.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // aplicar validacion de nuestros datos
        $validator = Validator::make($request->all(), [
            'cod_oficina'=> 'required|string|min:3|max:12',
            'nombre_oficina'=> 'required|string|min:2|max:220',
             
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
            $cod_oficina = $request->get('cod_oficina');
            $nombre_oficina = $request->get('nombre_oficina');
            
            // crear un nuevo registro en la BD
            // INSERT INTO tipocurso (nombre_oficinas, activo) VALUES ($nombre_oficina, 1)
            $oficina = new oficina();
            $oficina->cod_oficina = $cod_oficina;
            $oficina->nombre_oficina = $nombre_oficina;
            $oficina->save(); // encargado de aplicar el insert into

            $data = [
                'message' => 'Registrado correctamente'
            ];
            return response()->json($data, 201);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = [
                'message' => 'Error al registrar el oficina. Contactarse con el area de soporte'
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $cod_oficina)
    {
        try {
            // select * from tipocurso WHERE id = $id
            $oficina = oficina::find($cod_oficina);
            // $tipocurso = Tipocurso::where('id', '=', $id)->first();
            return view('admin.oficina.edit', ["item" => $oficina]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $cod_oficina)
    {
        $validator = Validator::make($request->all(), [
            'cod_oficina' => 'required|string|min:3|max:12',
            'nombre_oficina' => 'required|string|min:3|max:150'

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
            $oficina = oficina::find($cod_oficina);
            $oficina->cod_oficina = $request->get('cod_oficina');
            $oficina->nombre_oficina = $request->get('nombre_oficina');
            
            $oficina->save(); // aplicando el UPDATE tipocurso SET nombre_oficina = $reques WHERE id = $id
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
    public function destroy(string $cod_oficina)
    {
        try {
            $oficina = oficina::find($cod_oficina);
            $oficina->delete(); // DELETE FROM tipocurso WHERE id =$id
            // UPDATE tipocurso SET deleted_at = TIMESTAMP where id = $id

            $data = ['message' => 'Eliminado correctamente'];

            return response()->json($data, 200);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = ['message' => 'Error al eliminar oficina'];

            return response()->json($data, 500);
        }
    }
}
