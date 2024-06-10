<?php
namespace App\Exports;

use App\Models\salida;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class YourExport implements FromCollection, WithHeadings
{
    protected $fecha_salida;
    protected $fecha_retorno;

    public function __construct($fecha_salida, $fecha_retorno)
    {
        $this->fecha_salida = $fecha_salida;
        $this->fecha_retorno = $fecha_retorno;
    }

    public function collection()
    {
        return salida::whereBetween('fecha_salida', [$this->fecha_salida, $this->fecha_retorno])
        ->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'cod_persona',
            'nombre',
            'apellido',
            'nombre articulo',
            'cantidad',
            'unidad_medida',
            'fecha_salida',
            'tipo_salida',
            'fecha retorno',
            'observaciones',
            'devoluciones',
            
            
        ];
    }
}
