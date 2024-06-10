<?php

namespace App\Exports;

use App\Models\articulo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class articuloExport implements FromCollection, WithHeadings
{
    use Exportable;

    public function collection()
    {
        return articulo::select('cuenta','fecha_entrada','documento','nro_comprobante','procedencia','forma_ingreso','nombre_articulo','nombre_categoria','stock','caracteristica','marca','modelo','nro_serie','color','precio')
        ->get();
    }

    public function headings(): array
    {
        return [
            
            'cuenta',
            // 'cod_barra',
            'fecha_entrada',
            'documento',
            'nro_comprobante',
            'procedencia',
            'forma_ingreso',
            'nombre_articulo',
            'nombre_categoria',
            'stock',
            'caracteristica',
            'marca','modelo',
            'nro_serie',
            'color',
            'precio'
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Estilo para la primera fila (encabezados)
            1 => [
                'font' => [
                    'bold' => true,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => 'FF0000',
                    ],
                ],
            ],
        ];
    }
}