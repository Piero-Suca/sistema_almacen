<?php
namespace App\Http\Controllers;
use App\Models\personal;
use App\Models\oficina;
use App\Models\especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
//uso de la libreria
use Barryvdh\DomPDF\Facade\Pdf;

class personalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("admin.personal.index");
    }
     //crear metodo pdf
     public function pdf(){
        $personal = personal::all();
        $pdf = Pdf::loadView('admin.personal.pdf', compact('personal'));
        return $pdf->stream();
    }
    public function search(Request $request)
    {
        // recuerar el parametro busqueda
        $busqueda = $request->get('busqueda', '');

        // realizar la busqueda
        // ORM -> ELOQUENT
        // select id, nombres from tipocurso WHERE nombres LIKE '%diplomado%' AND deleted_at IS NULL

        $listado = personal::join('especialidad', 'personal.nombre_especialidad', '=', 'especialidad.nombre_especialidad')
            ->join('oficina', 'personal.nombre_oficina', '=', 'oficina.nombre_oficina')
            ->where('personal.nombres','LIKE', '%' . $busqueda . '%')
            ->select('personal.id','personal.cod_personal','personal.nombres','personal.apellidos','personal.nro_celular','personal.nombre_oficina','personal.nombre_especialidad','oficina.nombre_oficina AS nombre_oficina' , 'especialidad.nombre_especialidad AS nombre_especialidad')
            ->get();
         return view("admin.personal.list", [
                "listado" => $listado
            ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $especialidades = especialidad::orderBy('nombre_especialidad', 'ASC')->select('id', 'nombre_especialidad')->get();
    $oficinas = oficina::orderBy('nombre_oficina', 'ASC')->select('id', 'nombre_oficina')->get();

    return view("admin.personal.create", [
        'especialidades' => $especialidades,
        'oficinas' => $oficinas,
    ]);
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // aplicar validacion de nuestros datos
        $validator = Validator::make($request->all(), [
            'cod_personal' => 'required|string|min:8|max:12',
            'nombres' => 'required|string|min:1|max:220',
            'apellidos' => 'required|string|min:1|max:220',
            'nro_celular' => 'required|string|min:9|max:12',
            'nombre_oficina' => 'required|string|min:1|max:220',
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
            
            $nombres = $request->get('nombres');
            $cod_personal = $request->get('cod_personal');
            $apellidos = $request->get('apellidos');
            $nro_celular = $request->get('nro_celular');
            $nombre_oficina = $request->get('nombre_oficina');
            $nombre_especialidad = $request->get('nombre_especialidad');
            $personal = new personal();
            $personal->nombres = $nombres;
            $personal->cod_personal = $cod_personal;
            $personal->apellidos = $apellidos;
            $personal->nro_celular = $nro_celular;
            $personal->nombre_oficina = $nombre_oficina;
            $personal->nombre_especialidad = $nombre_especialidad;
            $personal ->save(); // encargado de aplicar el insert into

            $data = [
                'message' => 'Registrado correctamente'
            ];
            return response()->json($data, 201);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = [
                'message' => 'Error al registrar el personal. Contactarse con el area de soporte'
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
        $personal = personal::find($id);
        $oficina_personal = oficina::orderBy('nombre_oficina', 'ASC')->select('id', 'nombre_oficina')->get();
        $especialidad_personal = especialidad::orderBy('nombre_especialidad', 'ASC')->select('id', 'nombre_especialidad')->get();

        return view('admin.personal.edit', [
            "item" => $personal,
            "oficina_personal" => $oficina_personal,
            "especialidad_personal" => $especialidad_personal,
        ]);
    } catch (\Throwable $error) {
        Log::error($error->getMessage());
        $data = [
            'message' => 'ERROR AL REGISTRAR EL PERSONAL. CONTACTARSE CON EL AREA DE SOPORTE'
        ];
        return response()->json($data, 500);
    }
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $cod_personal)
    {
        $validator = Validator::make($request->all(), [
            'nombres' => 'required|string|min:3|max:120',
            'cod_personal' => 'required|string|min:2|max:12',
            'apellidos' => 'required|string|min:3|max:150',
            'nro_celular' => 'required|string|min:3|max:12',
            'nombre_oficina' => 'required|string|min:0|max:300',
            'nombre_especialidad' => 'required|string|min:0|max:300',
           
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
            $personal = personal::find($cod_personal);
            $personal->cod_personal = $request->get('cod_personal');
            $personal->nombres = $request->get('nombres');
            $personal->apellidos = $request->get('apellidos');
            $personal->nro_celular = $request->get('nro_celular');
            $personal->nombre_oficina = $request->get('nombre_oficina');
            $personal->nombre_especialidad = $request->get('nombre_especialidad');
            $personal->save(); // aplicando el UPDATE tipocurso SET nombres = $reques WHERE id = $id
            $data = ['message' => 'Actualizado correctamente'];
            return response()->json($data, 200);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());
            $data = [
                'message' => 'Error al actualizar el personal controller'
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $cod_personal)
    {
        try {
            $personal = personal::find($cod_personal);
            $personal->delete(); // DELETE FROM tipocurso WHERE id =$id
            // UPDATE tipocurso SET deleted_at = TIMESTAMP where id = $id

            $data = ['message' => 'Eliminado correctamente'];

            return response()->json($data, 200);
        } catch (\Throwable $error) {
            Log::error($error->getMessage());

            $data = ['message' => 'Error al eliminar personal'];

            return response()->json($data, 500);
        }
    }
}
