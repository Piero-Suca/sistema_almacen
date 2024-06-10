<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
//uso de la libreria
use Barryvdh\DomPDF\Facade\Pdf;

class usuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.usuario.index");
    }
     //crear metodo pdf
     public function pdf(){
        $usuario = User::all();
        $pdf = Pdf::loadView('admin.usuario.pdf', compact('usuario'));
        return $pdf->stream();
    }
    public function search(Request $request)
    {
        // recuerar el parametro busqueda
        $busqueda = $request->get('busqueda', '');

        // realizar la busqueda
        // ORM -> ELOQUENT
        // select id, name from tipocurso WHERE name LIKE '%diplomado%' AND deleted_at IS NULL
        $listado = User::where('name', 'LIKE', '%' . $busqueda . '%')
        ->select('id','email','name')
        ->get();
        return view("admin.usuario.list", [
            "listado" => $listado
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.usuario.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // aplicar validacion de nuestros datos
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|string|min:2|max:50',
            'password' => 'required|string|min:8|confirmed',
            
            
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
            
            
            $usuario = new User();
            $usuario->name = $request->get('name');
            $usuario->email = $request->get('email');
            $usuario->password = Hash::make($request->get('password'));
            $usuario ->save(); // encargado de aplicar el insert into

            $data = [
                'message' => 'Registrado correctamente'
            ];
            return response()->json($data, 201);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = [
                'message' => 'Error al registrar el usuario. Contactarse con el area de soporte'
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
            $usuario = User::find($id);
            return view('admin.usuario.edit', ["item" => $usuario]);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());
            $data = [
                'message' => 'Error al registrar el usuario. Contactarse con el area de soporte'
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:1|max:100',
            'email' => 'required|string|min:2|max:50',
            'password' => 'required|string|min:8|confirmed',
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
            $usuario = User::find($id);
            $usuario->name = $request->get('name');
            $usuario->email = $request->get('email');
            $usuario->password = Hash::make($request->get('password'));
            
            
            $usuario->save(); // aplicando el UPDATE tipocurso SET name = $reques WHERE id = $id
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
    public function destroy(string $id)
    {
        try {
            $usuario = User::find($id);
            $usuario->delete(); // DELETE FROM tipocurso WHERE id =$id
            // UPDATE tipocurso SET deleted_at = TIMESTAMP where id = $id

            $data = ['message' => 'Eliminado correctamente'];

            return response()->json($data, 200);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = ['message' => 'Error al eliminar usuario'];

            return response()->json($data, 500);
        }
    }
}
