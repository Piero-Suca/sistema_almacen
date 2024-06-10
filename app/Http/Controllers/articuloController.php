<?php

namespace App\Http\Controllers;

use App\Models\articulo;
use App\Models\categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


//uso de la libreria
use Barryvdh\DomPDF\Facade\Pdf;
//use Maatwebsite\Excel\Excel as Formato;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\articuloExport;


class articuloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.articulo.index");
    }
     //crear metodo pdf

     
     public function exportToExcel()
     {
         // Obtén los datos de los programas que deseas exportar
         $articulo = articulo::all(); // Suponiendo que Programa es tu modelo
 
         // Exporta los datos a un archivo Excel
         return Excel::download(new articuloExport($articulo), 'articulo.xlsx');
    }



   



    public function search(Request $request)
    {
        // recuerar el parametro busqueda
        $busqueda = $request->get('busqueda', '');

        $listado = articulo::join('categoria', 'articulo.nombre_categoria', '=', 'categoria.nombre_categoria')
        ->where('nombre_articulo', 'LIKE', '%' . $busqueda . '%')
        ->orWhere('cod_barra', 'LIKE', '%' . $busqueda . '%')
        ->select('articulo.id','articulo.cuenta','articulo.fecha_entrada','articulo.documento','articulo.nro_comprobante','articulo.procedencia','articulo.forma_ingreso','articulo.nombre_articulo','articulo.nombre_categoria','articulo.stock','articulo.caracteristica','articulo.marca','articulo.modelo','articulo.nro_serie','articulo.color','articulo.precio', 'categoria.nombre_categoria AS nombre_categoria')
        ->get();
        return view("admin.articulo.list", [
            "listado" => $listado
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoria = categoria::orderBy('nombre_categoria', 'ASC')->select('nombre_categoria')->get();
        return view("admin.articulo.create", ['categoria' => $categoria]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // aplicar validacion de nuestros datos
        $validator = Validator::make($request->all(), [
            'cuenta'=>'required|string|min:1|max:20',
            'fecha_entrada' => 'required|date',
            'nro_comprobante'=> 'required|string|min:1|max:25',
            'nombre_articulo'=> 'required|string|min:1|max:10000',
            'caracteristica'=> 'required|string|min:1|max:220',
            'stock'=> 'required|string|min:1|max:5',
            'marca'=> 'required|string|min:1|max:220',
            'modelo'=> 'required|string|min:1|max:220',
            'nro_serie'=> 'required|string|min:1|max:50',
            'color'=> 'required|string|min:1|max:220',
            'precio'=> 'required|string|min:2|max:8',
            
            //'documento'=> 'required|string|min:1|max:200',
            // 'forma_ingreso'=> 'required|string|min:1|max:200',
            // 'procendencia'=> 'required|string|min:1|max:200',
            //'nombre_categoria'=> 'required|string|min:1|max:200',
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
           
            
            $cuenta= $request->get('cuenta');
            // $cod_barra= $request->get('cod_barra');
            $fecha_entrada = $request->get('fecha_entrada');
            $documento= $request->get('documento');
            $nro_comprobante= $request->get('nro_comprobante');
            $procedencia= $request->get('procedencia');
            $forma_ingreso= $request->get('forma_ingreso');
            $nombre_articulo = $request->get('nombre_articulo');
            $nombre_categoria = $request->get('nombre_categoria');
            $stock = $request->get('stock');
            $caracteristica= $request->get('caracteristica');
            $marca= $request->get('marca');
            $modelo = $request->get('modelo');
            $nro_serie = $request->get('nro_serie');
            $color= $request->get('color');
            $precio= $request->get('precio');
            // $estado = $request->get('estado');
            
            // $unidad_medida = $request->get('unidad_medida');
                        
            // crear un nuevo registro en la BD
            // INSERT INTO tipocurso (fecha_entradas, activo) VALUES ($fecha_entrada, 1)
            $articulo = new articulo();
          
            
            $articulo->cuenta = $cuenta;
            // $articulo->cod_barra = $cod_barra;
            $articulo->fecha_entrada = $fecha_entrada;
            $articulo->documento = $documento;
            $articulo->nro_comprobante = $nro_comprobante;
            $articulo->procedencia = $procedencia;
            $articulo->forma_ingreso = $forma_ingreso;
            $articulo->nombre_articulo = $nombre_articulo;
            $articulo->nombre_categoria = $nombre_categoria;
            $articulo->stock = $stock;
            $articulo->caracteristica = $caracteristica;
            $articulo->marca = $marca;
            $articulo->modelo = $modelo;
            $articulo->nro_serie = $nro_serie;
            $articulo->color = $color;
            $articulo->precio = $precio;
            // $articulo->estado = $estado;
            
            // $articulo->unidad_medida = $unidad_medida;
            
            $articulo->save(); // encargado de aplicar el insert into

            $data = [
                'message' => 'Registrado correctamente'
            ];
            return response()->json($data, 201);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = [
                'message' => 'Error al registrar el articulo. Contactarse con el area de soporte'
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
            $articulo = articulo::find($id);
            $categoria_articulo = categoria::orderBy('nombre_categoria', 'ASC')->select('nombre_categoria')->get();

            return view('admin.articulo.edit',[
                "item" => $articulo,
                "categoria_articulo" => $categoria_articulo,
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
    public function update(Request $request, string $nombre_articulo)
    {
        $validator = Validator::make($request->all(), [
            'nombre_articulo' => 'required|string|min:1|max:150',

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
            $articulo = articulo::find($nombre_articulo);
            $articulo->cuenta = $request->get('cuenta');
            // $articulo->cod_barra = $request->get('cod_barra');
            $articulo->fecha_entrada = $request->get('fecha_entrada');
            $articulo->documento = $request->get('documento');
            $articulo->nro_comprobante = $request->get('nro_comprobante');
            $articulo->procedencia = $request->get('procedencia');
            $articulo->forma_ingreso = $request->get('forma_ingreso');
            $articulo->nombre_articulo = $request->get('nombre_articulo');
            $articulo->nombre_categoria = $request->get('nombre_categoria');
            $articulo->stock = $request->get('stock');
            $articulo->caracteristica = $request->get('caracteristica');
            $articulo->marca = $request->get('marca');
            $articulo->modelo = $request->get('modelo');
            $articulo->nro_serie = $request->get('nro_serie');
            $articulo->color = $request->get('color');
            $articulo->precio = $request->get('precio');
            
            
            // $articulo->estado = $request->get('estado');
            
            // $articulo->unidad_medida = $request->get('unidad_medida');
            $articulo->save();
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
            $articulo = articulo::find($nombre_articulo);
            $articulo->delete(); // DELETE FROM tipocurso WHERE id =$id
            // UPDATE tipocurso SET deleted_at = TIMESTAMP where id = $id

            $data = ['message' => 'Eliminado correctamente'];

            return response()->json($data, 200);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = ['message' => 'Error al eliminar articulo'];

            return response()->json($data, 500);
        }
    }
}
