<?php

namespace App\Http\Controllers;

use App\Models\salida;
use App\Models\articulo;
use App\Models\persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
//uso de la libreria
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use App\Exports\YourExport;



class salidaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
     {
         return view("admin.salida.index");
     }



    public function buscarpersona(Request $request)
    {
         $cod_persona = $request->input('cod_persona');
         $persona = persona::where('cod_persona', $cod_persona)->first();
 
         if ($persona) {
             return response()->json([
                 'nombres' => $persona->nombres,
                 'apellidos' => $persona->apellidos,
             ]);
         } else {
             return response()->json(['error' => 'Persona no encontrada'], 404);
         }
    }



    public function rfechas(Request $request)
{
    // Obtener los parámetros de búsqueda del formulario
    $fecha_inicio = $request->input('fecha_salida');
    $fecha_fin = $request->input('fecha_retorno');

    // Crear un arreglo para almacenar las fechas
    $fechas = [];

    // Construir la consulta para obtener solo las fechas dentro del rango especificado
    $query = salida::whereBetween('fecha_salida', [$fecha_inicio, $fecha_fin])->pluck('fecha_retorno');

    // Almacenar las fechas en el arreglo
    foreach ($query as $fechas) {
        $fechas[] = $fechas;
    }

    // Pasar las fechas a la vista del PDF
    $fechas = PDF::loadView('admin.salida.rfechas', compact('fechas'));

    // Descargar el archivo PDF
    return $fechas->stream();
}

////////////////////////////
// public function exportToExcel(Request $request)
// {
//     $fecha_inicio = $request->input('fecha_inicio');
//     $fecha_fin = $request->input('fecha_fin');
    
//     // Generate your data based on the input dates

//     return Excel::download(new YourExport($fecha_inicio, $fecha_fin), 'data.xlsx');
// }





//esto es del tercer formulario
    public function export(Request $request)
    {
        $fecha_salida = $request->input('fecha_salida');
        $fecha_retorno = $request->input('fecha_retorno');

        return Excel::download(new ReportExport($fecha_salida, $fecha_retorno), 'report.xlsx'); // Utiliza Excel, no Exports
    }




     //crear metodo pdf
     public function pdf(){
        $salida = salida::all();
        $pdf = Pdf::loadView('admin.salida.pdf', compact('salida'));
        return $pdf->stream();
    }


    



    // public function search(Request $request)
    // {
    //     // recuerar el parametro busqueda
    //     $busqueda = $request->get('busqueda', '');
    //     $fecha_inicio = $request->input('fecha_inicio');
    //     $fecha_fin = $request->input('fecha_fin');

        
    //     $listado = salida::join('articulo','salida.nombre_articulo','=','articulo.nombre_articulo')


    //     // ->join('personal', 'salida.nombres', '=', 'personal.nombres')
    //     ->where('salida.cod_persona', 'LIKE', '%' . $busqueda . '%')
    //     ->OrWhere('salida.nombres', 'LIKE', '%' . $busqueda . '%')
    //     ->OrWhere('salida.nombre_articulo', 'LIKE', '%' . $busqueda . '%')
    //     ->OrWhere('salida.fecha_salida', 'LIKE', '%' . $busqueda . '%')
    //     ->OrWhere('salida.fecha_retorno', 'LIKE', '%' . $busqueda . '%')

    //     ->select('salida.id','salida.cod_persona','salida.nombres','salida.nombre_articulo','salida.cantidad','salida.unidad_medida','salida.fecha_salida','salida.tipo_salida','salida.fecha_retorno','salida.observaciones','salida.devoluciones','articulo.nombre_articulo AS nombre_articulo')
    //     ->get();
    //     return view("admin.salida.list", [
    //         "listado" => $listado
    //     ]);
    // }
    public function search(Request $request)
{
    // Obtener los parámetros de búsqueda del formulario
    $busqueda = $request->input('busqueda', '');
    $fecha_inicio = $request->input('fecha_inicio');
    $fecha_fin = $request->input('fecha_fin');

    // Construir la consulta inicial
    $query = Salida::join('articulo', 'salida.nombre_articulo', '=', 'articulo.nombre_articulo')
        ->select('salida.id', 'salida.cod_persona', 'salida.nombres','salida.apellidos', 'salida.nombre_articulo', 'salida.cantidad', 'salida.unidad_medida', 'salida.fecha_salida', 'salida.tipo_salida', 'salida.fecha_retorno', 'salida.observaciones', 'salida.devoluciones', 'articulo.nombre_articulo AS nombre_articulo');

    // Aplicar filtro por palabra clave
    if (!empty($busqueda)) {
        $query->where(function ($q) use ($busqueda) {
            $q->where('salida.cod_persona', 'LIKE', '%' . $busqueda . '%')
                ->orWhere('salida.nombres', 'LIKE', '%' . $busqueda . '%')
                ->orWhere('salida.nombre_articulo', 'LIKE', '%' . $busqueda . '%')
                ->orWhere('salida.fecha_salida', 'LIKE', '%' . $busqueda . '%')
                ->orWhere('salida.fecha_retorno', 'LIKE', '%' . $busqueda . '%');
        });
    }

    // Aplicar filtro por rango de fechas de préstamo si se proporcionan ambas fechas
    if (!empty($fecha_inicio) && !empty($fecha_fin)) {
        $query->whereDate('salida.fecha_salida', '>=', $fecha_inicio)
            ->whereDate('salida.fecha_salida', '<=', $fecha_fin);
    }

    // Obtener los resultados de la consulta con paginación
    $listado = $query->paginate(""); // Cambia el número 10 por el número deseado de elementos por página

    // Pasar los resultados a la vista
    return view("admin.salida.list", compact('listado'));
}
    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view("admin.salida.create");
    // }
    public function create()
    {
        $articulo = articulo::orderBy('nombre_articulo', 'ASC')->select('id', 'nombre_articulo')->get();
        return view("admin.salida.create", ['articulo' => $articulo]);
    }

    /**
     * Store a newly created resource in storage.
     */
//     public function store(Request $request)
//     {
//         // aplicar validacion de nuestros datos
//         $validator = Validator::make($request->all(), [
//             'cod_persona' => 'required|string|min:8|max:12',
//             // 'nombres' => 'required|string|min:1|max:220',
//             // 'apellidos' => 'required|string|min:1|max:220',
//             'nombre_articulo'=> 'required|string|min:1|max:10000',
//             'cantidad' => 'required|string|min:1|max:6',
//             // 'unidad_medida' => 'required',
//             'fecha_salida' => 'required|date|after_or_equal:fecha_salida',
//             //'tipo_salida' => 'required',
//             //'fecha_retorno' => 'required|date',
//             'observaciones' => 'required',
//             'devoluciones' => 'required',
            
//         ]);

//         if ($validator->fails()) {
//             // retornar la lista de errores JSON
//             $errors = $validator->errors();

//             $data = [
//                 'message' => 'Error en la validacion de los datos',
//                 'errors' => $errors
//             ];

//             return response()->json($data, 422);
//         }

//         try {
//             $cod_persona = $request->get('cod_persona');
//             $nombres = $request->get('nombres');
//             $apellidos = $request->get('apellidos');
//             $nombre_articulo = $request->get('nombre_articulo');
//             $cantidad = $request->get('cantidad');
//             $unidad_medida = $request->get('unidad_medida');
//             $fecha_salida = $request->get('fecha_salida');
//             $tipo_salida = $request->get('tipo_salida');
//             $fecha_retorno = $request->get('fecha_retorno');
//             $observaciones = $request->get('observaciones');
//             $devoluciones = $request->get('devoluciones');
            
//             $salida = new salida();
//             $salida->cod_persona = $cod_persona;
//             $salida->nombres = $nombres;
//             $salida->apellidos = $apellidos;
//             $salida->nombre_articulo = $nombre_articulo;
//             $salida->cantidad = $cantidad;
//             $salida->unidad_medida= $unidad_medida;
//             $salida->fecha_salida = $fecha_salida;
//             $salida->tipo_salida = $tipo_salida;
//             $salida->fecha_retorno = $fecha_retorno;
//             $salida->observaciones = $observaciones;
//             $salida->devoluciones = $devoluciones;
            
//             $salida ->save();

//             $articulo = articulo::where('nombre_articulo', $nombre_articulo)->first();

// // Verificar si la cantidad a reducir es menor o igual al stock actual
// if ($articulo->stock >= $cantidad) {
//     // Reducir la cantidad del stock actual
//     $articulo->stock -= $cantidad;
//     $articulo->save();
// } else {
//     // Si la cantidad es mayor que el stock actual, no realizar la operación
//     echo "¡No hay suficiente stock disponible!";
// }

// // Verificar si el stock es menor que cero
// if ($articulo->stock < 0) {
//     // Enviar un mensaje indicando que el producto está agotado
//     echo "¡Producto agotado!";
// }

//             $data = [
//                 'message' => 'Registrado correctamente'
//             ];
//             return response()->json($data, 201);
//         } catch (\Throwable $error) {
//             Log::error($error->getMessage());

//             $data = [
//                 'message' => 'Error al registrar el salida. Contactarse con el area de soporte'
//             ];
//             return response()->json($data, 500);
//         }
//     }


public function store(Request $request)
{
    // aplicar validacion de nuestros datos
    $validator = Validator::make($request->all(), [
        'cod_persona' => 'required|string|min:8|max:12',
        // 'nombres' => 'required|string|min:1|max:220',
        // 'apellidos' => 'required|string|min:1|max:220',
        'nombre_articulo'=> 'required|string|min:1|max:10000',
        'cantidad' => 'required|string|min:1|max:6',
        // 'unidad_medida' => 'required',
        'fecha_salida' => 'required|date|after_or_equal:fecha_salida',
        //'tipo_salida' => 'required',
        //'fecha_retorno' => 'required|date',
        'observaciones' => 'required',
        'devoluciones' => 'required',
        
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
        $cod_persona = $request->get('cod_persona');
        $nombres = $request->get('nombres');
        $apellidos = $request->get('apellidos');
        $nombre_articulo = $request->get('nombre_articulo');
        $cantidad = $request->get('cantidad');
        $unidad_medida = $request->get('unidad_medida');
        $fecha_salida = $request->get('fecha_salida');
        $tipo_salida = $request->get('tipo_salida');
        $fecha_retorno = $request->get('fecha_retorno');
        $observaciones = $request->get('observaciones');
        $devoluciones = $request->get('devoluciones');
        
        $salida = new salida();
        $salida->cod_persona = $cod_persona;
        $salida->nombres = $nombres;
        $salida->apellidos = $apellidos;
        $salida->nombre_articulo = $nombre_articulo;
        $salida->cantidad = $cantidad;
        $salida->unidad_medida= $unidad_medida;
        $salida->fecha_salida = $fecha_salida;
        $salida->tipo_salida = $tipo_salida;
        $salida->fecha_retorno = $fecha_retorno;
        $salida->observaciones = $observaciones;
        $salida->devoluciones = $devoluciones;
        
        $salida->save();

        $articulo = articulo::where('nombre_articulo', $nombre_articulo)->first();

        // Verificar si la cantidad a reducir es menor o igual al stock actual
        if ($articulo->stock >= $cantidad) {
            // Reducir la cantidad del stock actual
            $articulo->stock -= $cantidad;
            $articulo->save();
        } else {
            // Si la cantidad es mayor que el stock actual, retornar un mensaje de error
            $data = [
                'message' => '¡No hay suficiente stock disponible!'
            ];
            return response()->json($data, 422);
        }

        // Verificar si el stock es menor que cero
        if ($articulo->stock < 0) {
            // Enviar un mensaje indicando que el producto está agotado
            $data = [
                'message' => '¡Producto agotado!'
            ];
            return response()->json($data, 422);
        }

        $data = [
            'message' => 'Registrado correctamente'
        ];
        return response()->json($data, 201);
    } catch (\Throwable $error) {
        Log::error($error->getMessage());

        $data = [
            'message' => 'Error al registrar el salida. Contactarse con el area de soporte'
        ];
        return response()->json($data, 500);
    }
}


    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $nombre_articulo)
    // {
    //     try {
    //         $salida = salida::find($nombre_articulo);
    //         return view('admin.salida.edit', ["item" => $salida]);
    //     } catch (\Throwable $th) {
    //     }
    // }
    public function edit(string $id)
    {
        try {
            $salida = salida::find($id);
            $articulo_salida = articulo::orderBy('nombre_articulo', 'ASC')->select('id','nombre_articulo')->get();

            return view('admin.salida.edit',[
                "item" => $salida,
                "articulo_salida" => $articulo_salida,
            ]);
        }catch (\Throwable $error){
            Log::error($error->getMessage());
            $data = [
                'message' => 'ERROR AL REGISTRAR EL SALIDA. CONTACTARSE CON EL AREA DE SOPORTE'
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nombre_articulo)
    {
        $validator = Validator::make($request->all(), [
            'nombre_articulo' => 'required|string|min:1|max:150',
            // 'cod_persona' => 'required|string|min:1|max:150',
            // 'unidad_medida' => 'required|string|min:1|max:150',
            // 'fecha_salida' => 'required|string|min:1|max:10',
            // 'tipo_salida' => 'required|string|min:1|max:10',
            // 'fecha_retorno' => 'required|string|min:1|max:10',
            // 'observaciones' => 'required|string|min:1|max:150',
            // 'cantidad' => 'required|string|min:1|max:6',
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
            $salida = salida::find($nombre_articulo);
            $salida->cod_persona = $request->get('cod_persona');
            $salida->nombres = $request->get('nombres');
            $salida->apellidos = $request->get('apellidos');
            $salida->nombre_articulo = $request->get('nombre_articulo');
            $salida->cantidad = $request->get('cantidad');
            $salida->unidad_medida = $request->get('unidad_medida');
            $salida->fecha_salida = $request->get('fecha_salida');
            $salida->tipo_salida = $request->get('tipo_salida');
            $salida->fecha_retorno = $request->get('fecha_retorno');
            $salida->observaciones = $request->get('observaciones');
            $salida->devoluciones = $request->get('devoluciones');
           
            
            $salida->save(); // aplicando el UPDATE tipocurso SET cod_persona = $reques WHERE id = $id
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
    public function destroy(string $nombre_articulo)
    {
        try {
            $salida = salida::find($nombre_articulo);
            $salida->delete(); // DELETE FROM tipocurso WHERE id =$id
            // UPDATE tipocurso SET deleted_at = TIMESTAMP where id = $id

            $data = ['message' => 'Eliminado correctamente'];

            return response()->json($data, 200);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = ['message' => 'Error al eliminar salida'];

            return response()->json($data, 500);
        }
    }
}
