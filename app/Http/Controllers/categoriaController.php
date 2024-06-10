<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
//uso de la libreria
use Barryvdh\DomPDF\Facade\Pdf;

class categoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.categoria.index");
    }
     //crear metodo pdf
     public function pdf(){
        $categorias = categoria::all();
        $pdf = Pdf::loadView('admin.categoria.pdf', compact('categorias'));
        return $pdf->stream();
    }
    public function search(Request $request)
    {
        // recuerar el parametro busqueda
        $busqueda = $request->get('busqueda', '');

        // realizar la busqueda
        // ORM -> ELOQUENT
        // select id, nombre_categoria from tipocurso WHERE nombre_categoria LIKE '%diplomado%' AND deleted_at IS NULL
        $listado = categoria::where('nombre_categoria', 'LIKE', '%' . $busqueda . '%')
        ->select('id','cod_categoria','nombre_categoria')->get();
        return view("admin.categoria.list", [
            "listado" => $listado
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.categoria.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // aplicar validacion de nuestros datos
        $validator = Validator::make($request->all(), [
            'cod_categoria' => 'required|string|min:1|max:20',
            'nombre_categoria' => 'required|string|min:1|max:220',
            
           
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
            
            $cod_categoria = $request->get('cod_categoria');
            $nombre_categoria = $request->get('nombre_categoria');
            
           
            // crear un nuevo registro en la BD
            // INSERT INTO tipocurso (nombre_categorias, activo) VALUES ($nombre_categoria, 1)
            $categoria = new categoria();
            $categoria->cod_categoria = $cod_categoria;
            $categoria->nombre_categoria = $nombre_categoria;
            
           
            $categoria ->save(); // encargado de aplicar el insert into

            $data = [
                'message' => 'Registrado correctamente'
            ];
            return response()->json($data, 201);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = [
                'message' => 'Error al registrar el categoria. Contactarse con el area de soporte'
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $cod_categoria)
    {
        try {
            // select * from tipocurso WHERE id = $id
            $categoria = categoria::find($cod_categoria);
            // $tipocurso = Tipocurso::where('id', '=', $id)->first();
            return view('admin.categoria.edit', ["item" => $categoria]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $cod_categoria)
    {
        $validator = Validator::make($request->all(), [
            'cod_categoria' => 'required|string|min:2|max:20',
            'nombre_categoria' => 'required|string|min:2|max:200',
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
            $categoria = categoria::find($cod_categoria);
            $categoria->cod_categoria = $request->get('cod_categoria');
            $categoria->nombre_categoria = $request->get('nombre_categoria');
            
           
            $categoria->save(); // aplicando el UPDATE tipocurso SET nombre_categoria = $reques WHERE id = $id
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
    public function destroy(string $cod_categoria)
    {
        try {
            $categoria = categoria::find($cod_categoria);
            $categoria->delete(); // DELETE FROM tipocurso WHERE id =$id
            // UPDATE tipocurso SET deleted_at = TIMESTAMP where id = $id

            $data = ['message' => 'Eliminado correctamente'];

            return response()->json($data, 200);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = ['message' => 'Error al eliminar categoria'];

            return response()->json($data, 500);
        }
    }
}
