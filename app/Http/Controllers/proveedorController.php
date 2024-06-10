<?php

namespace App\Http\Controllers;

use App\Models\proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
//uso de la libreria
use Barryvdh\DomPDF\Facade\Pdf;

class proveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.proveedor.index");
    }
     //crear metodo pdf
     public function pdf(){
        $proveedor = proveedor::all();
        $pdf = Pdf::loadView('admin.proveedor.pdf', compact('proveedor'));
        return $pdf->stream();
    }
    public function search(Request $request)
    {
        // recuerar el parametro busqueda
        $busqueda = $request->get('busqueda', '');

        // realizar la busqueda
        // ORM -> ELOQUENT
        // select id, nombre_proveedor from tipocurso WHERE nombre_proveedor LIKE '%diplomado%' AND deleted_at IS NULL
        $listado = proveedor::where('nombre_proveedor', 'LIKE', '%' . $busqueda . '%')
        ->select('id','cod_proveedor','nombre_proveedor','direccion','nro_celular')
        ->get();
        return view("admin.proveedor.list", [
            "listado" => $listado
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.proveedor.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // aplicar validacion de nuestros datos
        $validator = Validator::make($request->all(), [
            'nombre_proveedor' => 'required|string|min:1|max:220',
            'cod_proveedor' => 'required|string|min:1|max:150',
            'direccion' => 'required|string|min:1|max:220',
            'nro_celular' => 'required|string|min:9|max:12'
            
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
            
            $nombre_proveedor = $request->get('nombre_proveedor');
            $cod_proveedor = $request->get('cod_proveedor');
            $direccion = $request->get('direccion');
            $nro_celular = $request->get('nro_celular');
           
            // crear un nuevo registro en la BD
            // INSERT INTO tipocurso (nombre_proveedors, activo) VALUES ($nombre_proveedor, 1)
            $proveedor = new proveedor();
            $proveedor->nombre_proveedor = $nombre_proveedor;
            $proveedor->cod_proveedor = $cod_proveedor;
            $proveedor->direccion = $direccion;
            $proveedor->nro_celular = $nro_celular;
            
            $proveedor ->save(); // encargado de aplicar el insert into

            $data = [
                'message' => 'Registrado correctamente'
            ];
            return response()->json($data, 201);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = [
                'message' => 'Error al registrar el proveedor. Contactarse con el area de soporte'
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $cod_proveedor)
    {
        try {
            // select * from tipocurso WHERE id = $id
            $proveedor = proveedor::find($cod_proveedor);
            // $tipocurso = Tipocurso::where('id', '=', $id)->first();
            return view('admin.proveedor.edit', ["item" => $proveedor]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $cod_proveedor)
    {
        $validator = Validator::make($request->all(), [
            'nombre_proveedor' => 'required|string|min:3|max:50'
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
            $proveedor = proveedor::find($cod_proveedor);
            $proveedor->nombre_proveedor = $request->get('nombre_proveedor');
            $proveedor->cod_proveedor = $request->get('cod_proveedor');
            $proveedor->direccion = $request->get('direccion');
            $proveedor->nro_celular = $request->get('nro_celular');
            
            $proveedor->save(); // aplicando el UPDATE tipocurso SET nombre_proveedor = $reques WHERE id = $id
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
    public function destroy(string $cod_proveedor)
    {
        try {
            $proveedor = proveedor::find($cod_proveedor);
            $proveedor->delete(); // DELETE FROM tipocurso WHERE id =$id
            // UPDATE tipocurso SET deleted_at = TIMESTAMP where id = $id

            $data = ['message' => 'Eliminado correctamente'];

            return response()->json($data, 200);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = ['message' => 'Error al eliminar proveedor'];

            return response()->json($data, 500);
        }
    }
}
