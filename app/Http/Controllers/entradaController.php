<?php

namespace App\Http\Controllers;

use App\Models\entrada;
use App\Models\proveedor;
use App\Models\articulo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
//uso de la libreria
use Barryvdh\DomPDF\Facade\Pdf;

class entradaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.entrada.index");
    }
     //crear metodo pdf
     public function pdf(){
        $entradas = entrada::all();
        $pdf = Pdf::loadView('admin.entrada.pdf', compact('entradas'));
        return $pdf->stream();
    }

    
    
    // public function sumar(Request $request)
    // {
    //     // Valida los datos de entrada
    //     $request->validate([
    //         'nombre_articulo' => 'required',
    //         'quantity' => 'required|integer|min:1', // La cantidad debe ser un número entero positivo
    //     ]);

    //     // Crea una nueva entrada
    //     $entrada = entrada::sumar([
    //         'nombre_articulo' => $request->nombre_articulo,
    //         'quantity' => $request->quantity,
    //     ]);

    //     // Actualiza el stock del artículo correspondiente
    //     $articulo = articulo::find($request->nombre_articulo);
    //     $articulo->stock += $request->quantity;
    //     $articulo->save();

    //     // Redirecciona o devuelve una respuesta adecuada según tus necesidades
    // }




    public function search(Request $request)
    {
        // recuerar el parametro busqueda
        $busqueda = $request->get('busqueda', '');

        // realizar la busqueda
        // ORM -> ELOQUENT
        // select id, nombre_entrada from tipocurso WHERE nombre_entrada LIKE '%diplomado%' AND deleted_at IS NULL
        $listado = entrada::join('proveedor','entrada.proveedor','=', 'proveedor.nombre_proveedor')
        ->join('articulo','entrada.nombre_articulo','=', 'articulo.nombre_articulo')
        ->where('entrada.nombre_articulo','LIKE', '%' . $busqueda . '%')
        ->select('entrada.id','entrada.nombre_articulo','entrada.cantidad','entrada.fecha_entrada','entrada.proveedor','entrada.precio','entrada.proveedor AS proveedor.nombre_proveedor','entrada.nombre_articulo AS articulo.nombre_articulo')
        ->get();
        return view("admin.entrada.list", [
            "listado" => $listado
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view("admin.entrada.create");
    // }
    public function create()
    {
        $proveedores = proveedor::orderBy('nombre_proveedor', 'ASC')->select('id', 'nombre_proveedor')->get();
        $articulos = articulo::orderBy('nombre_articulo', 'ASC')->select('id', 'nombre_articulo')->get();

        return view("admin.entrada.create", [
            'proveedores' => $proveedores,
            'articulos' => $articulos,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // aplicar validacion de nuestros datos
    $validator = Validator::make($request->all(), [
        
        'nombre_articulo'=> 'required|string|min:2|max:220',
        'cantidad'=> 'required|string|min:1|max:6',
        'fecha_entrada'=> 'required|date',
        'precio'=> 'required|string|min:1|max:6',
        'proveedor'=> 'required|string|min:1|max:220',

         
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
       
        $nombre_articulo = $request->get('nombre_articulo');
        $cantidad = $request->get('cantidad');
        $fecha_entrada = $request->get('fecha_entrada');
        $proveedor= $request->get('proveedor');
        $precio = $request->get('precio');
        
        // crear un nuevo registro en la BD
        // INSERT INTO tipocurso (nombre_entradas, activo) VALUES ($nombre_entrada, 1)
        $entrada = new entrada();
    
        $entrada->nombre_articulo = $nombre_articulo;
        $entrada->cantidad = $cantidad;
        $entrada->fecha_entrada = $fecha_entrada;
        $entrada->proveedor = $proveedor;
        $entrada->precio = $precio;
       
        
        $entrada->save(); // encargado de aplicar el insert into

        // Aumentar el stock del artículo correspondiente
        $articulo = articulo::where('nombre_articulo', $nombre_articulo)->first();
        $articulo->stock += $cantidad; // Suma la cantidad de entrada al stock actual
        $articulo->save(); // Guarda los cambios en la base de datos

        $data = [
            'message' => 'Registrado correctamente'
        ];
        return response()->json($data, 201);
    } catch (\Throwable $error) {
        Log::error($error->getMessage());

        $data = [
            'message' => 'Error al registrar el entrada. Contactarse con el area de soporte'
        ];
        return response()->json($data, 500);
    }
}


    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $cod_entrada)
    // {
    //     try {
    //         // select * from tipocurso WHERE id = $id
    //         $entrada = entrada::find($cod_entrada);
    //         // $tipocurso = Tipocurso::where('id', '=', $id)->first();
    //         return view('admin.entrada.edit', ["item" => $entrada]);
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }
    // }
    public function edit(string $id)
    {
        try {
            $entrada = entrada::find($id);
            $proveedor_entrada = proveedor::orderBy('nombre_proveedor', 'ASC')->select('id','nombre_proveedor')->get();
            $articulo_entrada = articulo::orderBy('nombre_articulo', 'ASC')->select('id','nombre_articulo')->get();

            return view('admin.entrada.edit',[
                "item" => $entrada,
                "proveedor_entrada" => $proveedor_entrada,
                "articulo_entrada" => $articulo_entrada,
            ]);
        }catch (\Throwable $error){
            Log::error($error->getMessage());
            $data = [
                'message' => 'ERROR AL REGISTRAR EL ESTUDIANTE. CONTACTARSE CON EL AREA DE SOPORTE'
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $cod_entrada)
    {
        $validator = Validator::make($request->all(), [
           
            'nombre_articulo'=> 'required|string|min:2|max:50',
            

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
            $entrada = entrada::find($cod_entrada);
            
            $entrada->nombre_articulo = $request->get('nombre_articulo');
            $entrada->cantidad = $request->get('cantidad');
            $entrada->fecha_entrada = $request->get('fecha_entrada');
            $entrada->proveedor = $request->get('proveedor');
            $entrada->precio = $request->get('precio');
            
            $entrada->save(); // aplicando el UPDATE tipocurso SET nombre_entrada = $reques WHERE id = $id
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
    public function destroy(string $cod_entrada)
    {
        try {
            $entrada = entrada::find($cod_entrada);
            $entrada->delete(); // DELETE FROM tipocurso WHERE id =$id
            // UPDATE tipocurso SET deleted_at = TIMESTAMP where id = $id

            $data = ['message' => 'Eliminado correctamente'];

            return response()->json($data, 200);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = ['message' => 'Error al eliminar entrada'];

            return response()->json($data, 500);
        }
    }
}
