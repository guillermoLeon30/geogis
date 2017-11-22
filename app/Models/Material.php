<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Excel;

class Material extends Model
{
	use SoftDeletes;

	protected $fillable = ['fecha', 'fuente', 'descripcion', 'unidad', 'costo'];
	protected $dates = ['deleted_at'];
    protected $table = 'materiales';

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
        Excel::create('Materiales', function ($excel){
            $excel->sheet('Hoja', function ($sheet){
                $campos = ['ID', 'DESCRIPCION', 'UNIDAD', 'COSTO'];
                $sheet->fromArray($campos, null, 'A1', false, false);
                $materiales = Material::all();
                $i = 1;
                
                foreach ($materiales as $material) {
                    $i++;
                    $id = sprintf('%d', $material->id);
                    $costo = sprintf('%.2f', $material->costo);
                    $fila = [$id, $material->descripcion, $material->unidad, $costo];
                    $sheet->appendRow($i, $fila);
                    $alto = Material::altoFila($material->descripcion,58);
                    $sheet->setHeight($i, $alto);
                    $sheet->getStyle('B'.$i)->getAlignment()->setWrapText(true);
                    $sheet->getStyle('D'.$i)->getNumberFormat()->setFormatCode('"$"#,##0.00_-');
                }

                $sheet->setPageMargin(array(0.75, 0.70, 0.75, 0.70));
                $sheet->setAutoSize(array('A', 'C', 'D'));
                $sheet->setWidth('B', 58);
                $sheet->getStyle('A1:D1')->applyFromArray(Material::estiloEncabezado());
                $sheet->getStyle('A2:D'.$i)->applyFromArray(Material::estiloTabla());
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
