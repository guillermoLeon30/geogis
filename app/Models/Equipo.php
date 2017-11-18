<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Excel;

class Equipo extends Model
{
	use SoftDeletes;

	protected $fillable = ['fecha', 'fuente', 'descripcion', 'costo_hora'];
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
        Excel::create('Equipos', function ($excel){
            $excel->sheet('Hoja', function ($sheet){
                $campos = ['ID', 'DESCRIPCION', 'COSTO/HORA'];
                $sheet->fromArray($campos, null, 'A1', false, false);
                $equipos = Equipo::all();
                $i = 1;
                
                foreach ($equipos as $equipo) {
                    $i++;
                    $id = sprintf('%d', $equipo->id);
                    $costo = sprintf('%.2f', $equipo->costo_hora);
                    $fila = [$id, $equipo->descripcion, $costo];
                    $sheet->appendRow($i, $fila);
                    $alto = Equipo::altoFila($equipo->descripcion,75);
                    $sheet->setHeight($i, $alto);
                    $sheet->getStyle('B'.$i)->getAlignment()->setWrapText(true);
                    $sheet->getStyle('C'.$i)->getNumberFormat()->setFormatCode('"$"#,##0.00_-');
                }

                $sheet->setPageMargin(array(0.75, 0.70, 0.75, 0.70));
                $sheet->setAutoSize(array('A', 'C'));
                $sheet->setWidth('B', 75);
                $sheet->getStyle('A1:C1')->applyFromArray(Equipo::estiloEncabezado());
                $sheet->getStyle('A2:C'.$i)->applyFromArray(Equipo::estiloTabla());
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
