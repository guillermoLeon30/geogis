<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Excel;

class Transporte extends Model
{
    use SoftDeletes;

	protected $fillable = ['fecha', 'fuente', 'descripcion', 'unidad', 'costo_km'];
	protected $dates = ['deleted_at'];

	//---------------------------------ALCANCES DE DATOS-------------------------------
    public function scopeBuscar($query, $buscar){
        return $query->where('descripcion', 'like', '%'.$buscar.'%');             
    }

    //-------------------------------------METODOS-------------------------------------

    public function fecha(){
    	return Carbon::createFromFormat('Y-m-d', $this->fecha)->format('d/m/Y');
    }

     /*******************************************************************************
    *   Funciones exportar excel
    *   @in 
    *   @out 
    *********************************************************************************/
    public static function excel(){
        Excel::create('Transportes', function ($excel){
            $excel->sheet('Hoja', function ($sheet){
                $campos = ['ID', 'DESCRIPCION', 'UNIDAD', 'COSTO/KM'];
                $sheet->fromArray($campos, null, 'A1', false, false);
                $transportes = Transporte::all();
                $i = 1;
                
                foreach ($transportes as $transporte) {
                    $i++;
                    $id = sprintf('%d', $transporte->id);
                    $costo = sprintf('%.2f', $transporte->costo_km);
                    $fila = [$id, $transporte->descripcion, $transporte->unidad, $costo];
                    $sheet->appendRow($i, $fila);
                    $alto = Transporte::altoFila($transporte->descripcion,58);
                    $sheet->setHeight($i, $alto);
                    $sheet->getStyle('B'.$i)->getAlignment()->setWrapText(true);
                    $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('"$"#,##0.00_-');
                }

                $sheet->setPageMargin(array(0.75, 0.70, 0.75, 0.70));
                $sheet->setAutoSize(array('A', 'C', 'D'));
                $sheet->setWidth('B', 58);
                $sheet->getStyle('A1:D1')->applyFromArray(Transporte::estiloEncabezado());
                $sheet->getStyle('A2:D'.$i)->applyFromArray(Transporte::estiloTabla());
                $sheet->getColumnDimension('A')->setVisible(false);
            });
        })->export('xlsx');
    }

    public static function altoFila($texto, $cAncho=8.43, $alto=15){
        $caracteres = strlen($texto);
        
        return intval($alto * ceil($caracteres / $cAncho));
    }

    public static function estiloEncabezado(){
        return array(
            'font' => array(
                'bold' => true,
            ),
            'alignment' => array(
                'horizontal' => 'center',
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => 'thin',
                ),
            )
        );
    }

    public static function estiloTabla(){
        return array(
            'borders' => array(
                'allborders' => array(
                    'style' => 'thin',
                ),
            )
        );
    }
}
