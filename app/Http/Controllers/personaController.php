<?php

namespace App\Http\Controllers;


use App\Models\persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
//uso de la libreria
use Barryvdh\DomPDF\Facade\Pdf;

class personaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    


    public function index()
    {
        return view("admin.persona.index");
    }
     //crear metodo pdf
     public function pdf(){
        $personas = persona::all();
        $pdf = Pdf::loadView('admin.persona.pdf', compact('personas'));
        return $pdf->stream();
    }
    public function search(Request $request)
    {
        // recuerar el parametro busqueda
        $busqueda = $request->get('busqueda', '');
        
        $listado = persona::where('nombres', 'LIKE', '%' . $busqueda . '%')
        ->orwhere('cod_persona','LIKE','%'.$busqueda.'%')
        ->select('id','cod_persona','nombres','apellidos','nro_celular','tipo_persona')
        ->get();
        return view("admin.persona.list", [
            "listado" => $listado
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.persona.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // aplicar validacion de nuestros datos
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|min:1|max:220',
            'cod_persona' => 'required|string|min:8|max:12',
            'apellidos' => 'required|string|min:1|max:2200',
            'nro_celular' => 'required|string|min:9|max:12',
            'tipo_persona' => 'required|string|min:1|max:220'
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
            
            $nombres = $request->get('nombres');
            $cod_persona = $request->get('cod_persona');
            $apellidos = $request->get('apellidos');
            $nro_celular = $request->get('nro_celular');
            $tipo_persona = $request->get('tipo_persona');
            // crear un nuevo registro en la BD
            // INSERT INTO tipocurso (nombress, activo) VALUES ($nombres, 1)
            $persona = new persona();
            $persona->nombres = $nombres;
            $persona->cod_persona = $cod_persona;
            $persona->apellidos = $apellidos;
            $persona->nro_celular = $nro_celular;
            $persona->tipo_persona = $tipo_persona;
            $persona ->save(); // encargado de aplicar el insert into

            $data = [
                'message' => 'Registrado correctamente'
            ];
            return response()->json($data, 201);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = [
                'message' => 'Error al registrar el persona. Contactarse con el area de soporte'
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $cod_persona)
    {
        try {
            // select * from tipocurso WHERE id = $id
            $persona = persona::find($cod_persona);
            // $tipocurso = Tipocurso::where('id', '=', $id)->first();
            return view('admin.persona.edit', ["item" => $persona]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $cod_persona)
    {
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|min:3|max:120',
            'cod_persona' => 'required|string|min:2|max:12',
            'apellidos' => 'required|string|min:3|max:150',
            'nro_celular' => 'required|string|min:3|max:12',
            'tipo_persona' => 'required|string|min:3|max:120'
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
            $persona = persona::find($cod_persona);
            $persona->nombres = $request->get('nombres');
            $persona->cod_persona = $request->get('cod_persona');
            $persona->apellidos = $request->get('apellidos');
            $persona->nro_celular = $request->get('nro_celular');
            $persona->tipo_persona = $request->get('tipo_persona');
            $persona->save(); // aplicando el UPDATE tipocurso SET nombres = $reques WHERE id = $id
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
    public function destroy(string $cod_persona)
    {
        try {
            $persona = persona::find($cod_persona);
            $persona->delete(); // DELETE FROM tipocurso WHERE id =$id
            // UPDATE tipocurso SET deleted_at = TIMESTAMP where id = $id

            $data = ['message' => 'Eliminado correctamente'];

            return response()->json($data, 200);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = ['message' => 'Error al eliminar persona'];

            return response()->json($data, 500);
        }
    }
}
