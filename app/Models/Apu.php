<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Equipo;
use App\Models\Material;
use App\Models\ManoDeObra;
use App\Models\Transporte;
use App\Models\Categoria;
use Excel;

class Apu extends Model
{
    protected $fillable = ['categoria_id', 'descripcion', 'unidad', 'por_indirectos', 'por_utilidad', 'cantidad'];

    //------------------------------------RELACIONES----------------------------------
    public function categoria(){
        return $this->belongsTo('App\Models\Categoria');
    }

	public function equipos(){
		return $this->belongsToMany('App\Models\Equipo')->withPivot('costo_hora2', 'cantidad', 'rendimiento');
	}

	public function materiales(){
		return $this->belongsToMany('App\Models\Material')->withPivot('costo2', 'cantidad');
	}

	public function manoDeObra(){
		return $this->belongsToMany('App\Models\ManoDeObra')->withPivot('costo_hora2', 'cantidad', 'rendimiento');
	}

	public function transportes(){
		return $this->belongsToMany('App\Models\Transporte')->withPivot('costo_km2', 'cantidad');
	}

	//--------------------------------------METODOS-----------------------------------
	/*******************************************************************************
    *	Funciones para generar totales
    *	@in 
    *	@out float
    *********************************************************************************/
    public function totalEquipo(){
    	return round($this->equipos->map(function ($equipo, $key){
    		return $equipo->pivot->costo_hora2 * $equipo->pivot->cantidad * $equipo->pivot->rendimiento;
    	})->sum(), 2);
    }

    public function totalMateriales(){
    	return round($this->materiales->map(function ($material, $key){
    		return $material->pivot->costo2 * $material->pivot->cantidad;
    	})->sum(), 2);
    }

    public function totalManoDeObra(){
    	return round($this->manoDeObra->map(function ($mano, $key){
    		return $mano->pivot->costo_hora2 * $mano->pivot->cantidad * $mano->pivot->rendimiento;
    	})->sum(), 2);
    }

    public function totalTransportes(){
    	return round($this->transportes->map(function ($transporte, $key){
    		return $transporte->pivot->costo_km2 * $transporte->pivot->cantidad;
    	})->sum(), 2);
    }

    public function total(){
    	return round($this->totalEquipo() + $this->totalMateriales() + $this->totalManoDeObra() + $this->totalTransportes(), 2);
    }

    public function totalIndirectos(){
        $subtotal = $this->total();
        
        return round($subtotal * $this->por_indirectos / 100, 2);
    }

    public function totalUtilidad(){
        $subtotal = $this->total();
        
        return $utilidad = round($subtotal * $this->por_utilidad / 100, 2);
    }

    public function totalGeneral(){
        $subtotal = $this->total();
        $indirectos = round($subtotal * $this->por_indirectos / 100, 2);
        $utilidad = round($subtotal * $this->por_utilidad / 100, 2);

        return $subtotal + $indirectos + $utilidad;
    }

    public function totalApuCantidad(){
        return round($this->totalGeneral() * $this->cantidad, 2);
    }

    /*******************************************************************************
    *   Funcion estatica que retorna una lista de objetos dependiendo de la fuente
    *   @in $fuente (string) [equipos, materiales, mano_de_obra, transporte]
    *   @in $filtro (srting) valor a buscar
    *   @out (collection(obj))
    *********************************************************************************/
    public static function selectores($fuente, $filtro){
        if ($fuente == 'equipos') {
            return Equipo::buscar($filtro)->get()->take(20);
        }elseif ($fuente == 'materiales') {
            return Material::buscar($filtro)->get()->take(20);
        }elseif ($fuente == 'mano_de_obra') {
            return ManoDeObra::buscar($filtro)->get()->take(20);
        }elseif ($fuente == 'transporte') {
            return Transporte::buscar($filtro)->get()->take(20);
        }
    }

    /*******************************************************************************
    *   Funcion para actualizar apu
    *   @in $info (Request->all)
    *   @out 
    *********************************************************************************/
    public function actualizar($info){
        $this->fill($info['datos']);
        $this->save();

        if (isset($info['equipos'])) {
            $this->equipos()->sync($this->formato1Update($info['equipos']));
        }else{
            $this->equipos()->detach();
        }
        if (isset($info['materiales'])) {
            $this->materiales()->sync($this->formato2Update($info['materiales']));
        }else{
            $this->materiales()->detach();
        }
        if (isset($info['manosObra'])) {
            $this->manoDeObra()->sync($this->formato1Update($info['manosObra']));
        }else{
            $this->manoDeObra()->detach();
        }
        if (isset($info['transportes'])) {
            $this->transportes()->sync($this->formato3Update($info['transportes']));
        }else{
            $this->transportes()->detach();
        }
    }

    public function formato1Update($arr){
        $a = array();

        foreach ($arr as $v) {
            $a[$v['id']] = ['costo_hora2'   =>  $v['costo'],
                            'cantidad'      =>  $v['cantidad'],
                            'rendimiento'   =>  $v['rendimiento']];
        }

        return $a;
    }

    public function formato2Update($arr){
        $a = array();

        foreach ($arr as $v) {
            $a[$v['id']] = ['costo2'    =>  $v['costo'],
                            'cantidad'  =>  $v['cantidad']];
        }

        return $a;
    }

    public function formato3Update($arr){
        $a = array();

        foreach ($arr as $v) {
            $a[$v['id']] = ['costo_km2' =>  $v['costo'],
                            'cantidad'  =>  $v['cantidad']];
        }

        return $a;
    }

    /*******************************************************************************
    *   Funcion para eliminar apu
    *   @in 
    *   @out 
    *********************************************************************************/
    public function eliminar(){
        $this->equipos()->detach();
        $this->materiales()->detach();
        $this->manoDeObra()->detach();
        $this->transportes()->detach();
        $this->delete();
    }

    /*******************************************************************************
    *   Funcion para obtener el codigo del apu
    *   @in 
    *   @out string
    *********************************************************************************/
    public function codigo(){
        return $this->categoria->codigo.'.'.$this->codigo;
    }
    
    /*******************************************************************************
    *   Funcion para crear un nuevo apu
    *   @in $request->all()
    *   @out 
    *********************************************************************************/
    public static function crear($datos){
        $apu = new Apu($datos);
        $apu->codigo = Apu::generarCodigo($datos['categoria_id']);
        $apu->save();
    }

    /*******************************************************************************
    *   Funcion para obtener un nuevo codigo para un apu
    *   @in 
    *   @out 
    *********************************************************************************/
    public static function generarCodigo($categoria_id){
        $codigo = Categoria::findOrFail($categoria_id)->apus->max('codigo');

        return (is_null($codigo))?1:$codigo+1;
    }

    /*******************************************************************************
    *   Funcion para mover la posicion del codigo hacia arriba o sea hacia 1
    *   @in  
    *   @out  
    *********************************************************************************/
    public function moverCodigoArriba(){
        $apuAnterior = Apu::where([['categoria_id', $this->categoria_id],
                                   ['codigo', $this->codigo - 1]])->get()->last();
        $apuAnterior->codigo = $this->codigo;
        $apuAnterior->save();
        $this->codigo = $this->codigo - 1;
        $this->save();
    }

    /*******************************************************************************
    *   Funcion para mover la posicion del codigo hacia abajo
    *   @in  
    *   @out  
    *********************************************************************************/
    public function moverCodigoAbajo(){
        $apuSiguiente = Apu::where([['categoria_id', $this->categoria_id],
                                    ['codigo', $this->codigo + 1]])->get()->last();
        $apuSiguiente->codigo = $this->codigo;
        $apuSiguiente->save();
        $this->codigo = $this->codigo + 1;
        $this->save();
    }

    /*******************************************************************************
    *   Funcion escojer el ultimo apu
    *   @in  
    *   @out  
    *********************************************************************************/
    public static function ultima($apu){
        return $apu->categoria->apus->sortBy('codigo')->last();
    }

    /*******************************************************************************
    *   Funcion para exportar un archivo de excel
    *   @in 
    *   @out 
    *********************************************************************************/
    public function excel(){
        Excel::create('apu', function ($excel){
            $this->hoja($excel);
        })->export('xlsx');
    }

    public function hoja($excel){
        $excel->sheet($this->codigo(), function ($sheet){
            $sheet->fromArray(array(
                    array('DIRECCION DE OPERACIONES TECNICAS'),
                    array('ANALISIS DE PRECIOS UNITARIOS'),
                    array('RUBRO:', $this->codigo()),
                    array('DESCRIPCIÓN:', $this->descripcion),
                    array('UNIDAD: ', $this->unidad)
            ), null, 'A1', false, false);
            $sheet->mergeCells('A1:G1', 'center');
            $sheet->mergeCells('A2:G2', 'center');
            $sheet->mergeCells('B3:G3', 'left');
            $sheet->mergeCells('B4:G4', 'left');
            $sheet->mergeCells('B5:G5');
            $sheet->getCell('A4')->getStyle()->getAlignment()->setVertical('center');
            $sheet->getCell('B4')->getStyle()->getAlignment()->setVertical('top');
            $sheet->getStyle('A1:A2')->applyFromArray($this->estiloEncabezado());
            $sheet->getStyle('A3:A5')->applyFromArray($this->estiloTotales());
            $sheet->getStyle('B3:B5')->applyFromArray($this->estiloTabla());
            //------------------------EQUIPOS-----------------------
            $tEquipos = $this->getEquiposForExcel();
            $sheet->rows($tEquipos);
            $sheet->mergeCells('A6:G6', 'center');
            $sheet->mergeCells('A7:C7', 'center');
                    
            $filas = count($tEquipos)-3;
            $inicio = 8;
            $this->darFormatoTablaExcel($filas, $inicio, $tEquipos, $sheet);
            $sheet->getStyle('A6')->applyFromArray($this->estiloEncabezado());
            $sheet->getStyle('A7:G7')->applyFromArray($this->estiloEncabezado());
            $sheet->getStyle('A'.$inicio.':G'.($inicio+$filas-1))->applyFromArray($this->estiloTabla());
            $sheet->getStyle('F'.($inicio+$filas).':G'.($inicio+$filas))->applyFromArray($this->estiloTabla());

            //-------------------------------------------------------
            //------------------MANO DE OBRA-------------------------
            $tMano = $this->getManoObForExcel();
            $sheet->rows($tMano);
            $inicio = count($tEquipos) + 1 + 5;
            $sheet->mergeCells('A'.$inicio.':G'.$inicio, 'center');
            $sheet->mergeCells('A'.($inicio + 1).':C'.($inicio + 1), 'center');

            $filas = count($tMano)-3;
            $inicio = $inicio + 2;
            $this->darFormatoTablaExcel($filas, $inicio, $tMano, $sheet);
            $sheet->getStyle('A'.($inicio - 2))->applyFromArray($this->estiloEncabezado());
            $sheet->getStyle('A'.($inicio-1).':G'.($inicio-1))->applyFromArray($this->estiloEncabezado());
            $sheet->getStyle('A'.$inicio.':G'.($inicio+$filas-1))->applyFromArray($this->estiloTabla());
            $sheet->getStyle('F'.($inicio+$filas).':G'.($inicio+$filas))->applyFromArray($this->estiloTabla());
            //-----------------------------------------------------------
            //----------------------MATERIALES---------------------------
            $tMateriales = $this->getMaterialesForExcel();
            $sheet->rows($tMateriales);
            $inicio = 5 + count($tEquipos) + count($tMano) + 1;
            $sheet->mergeCells('A'.$inicio.':G'.$inicio, 'center');
            $sheet->mergeCells('A'.($inicio + 1).':C'.($inicio + 1), 'center');

            $filas = count($tMateriales) - 3;
            $inicio = $inicio + 2;
            $this->darFormatoTablaExcel($filas, $inicio, $tMateriales, $sheet);
            $sheet->getStyle('A'.($inicio - 2))->applyFromArray($this->estiloEncabezado());
            $sheet->getStyle('A'.($inicio-1).':G'.($inicio-1))->applyFromArray($this->estiloEncabezado());
            $sheet->getStyle('A'.$inicio.':G'.($inicio+$filas-1))->applyFromArray($this->estiloTabla());
            $sheet->getStyle('F'.($inicio+$filas).':G'.($inicio+$filas))->applyFromArray($this->estiloTabla());
            //------------------------------------------------------------
            //---------------------TRANSPORTES----------------------------
            $tTranportes = $this->getTransportesForExcel();
            $sheet->rows($tTranportes);
            $inicio = 5 + count($tEquipos) + count($tMano) + count($tMateriales) + 1;
            $sheet->mergeCells('A'.$inicio.':G'.$inicio, 'center');
            $sheet->mergeCells('A'.($inicio + 1).':C'.($inicio + 1), 'center');

            $filas = count($tTranportes) - 3;
            $inicio = $inicio + 2;
            $this->darFormatoTablaExcel($filas, $inicio, $tTranportes, $sheet);
            $sheet->getStyle('A'.($inicio - 2))->applyFromArray($this->estiloEncabezado());
            $sheet->getStyle('A'.($inicio-1).':G'.($inicio-1))->applyFromArray($this->estiloEncabezado());
            $sheet->getStyle('A'.$inicio.':G'.($inicio+$filas-1))->applyFromArray($this->estiloTabla());
            $sheet->getStyle('F'.($inicio+$filas).':G'.($inicio+$filas))->applyFromArray($this->estiloTabla());
            //-------------------------------------------------------------
            //-----------------------TOTALES------------------------------
            $subtotal = sprintf('%.2f', $this->total());
            $indirectos = sprintf('%.2f', $this->totalIndirectos());
            $utilidad = sprintf('%.2f', $this->totalUtilidad());
            $total = sprintf('%.2f', $this->totalGeneral());

            $sheet->rows([
                ['', '', '', 'SUBTOTAL COSTO DIRECTO', '', '', $subtotal],
                ['', '', '', 'INDIRECTOS '.$this->por_indirectos.'%', '', '', $indirectos],
                ['', '', '', 'UTILIDAD '.$this->por_utilidad.'%', '', '', $utilidad],
                ['', '', '', 'COSTO TOTAL', '', '', $total]
            ]);
            $inicio = 5+count($tEquipos)+count($tMano)+count($tMateriales)+count($tTranportes)+1;
            $sheet->mergeCells('D'.$inicio.':F'.$inicio);
            $sheet->mergeCells('D'.($inicio + 1).':F'.($inicio + 1));
            $sheet->mergeCells('D'.($inicio + 2).':F'.($inicio + 2));
            $sheet->mergeCells('D'.($inicio + 3).':F'.($inicio + 3));
            $sheet->getStyle('D'.($inicio).':D'.($inicio+3))->applyFromArray($this->estiloTotales());
            $sheet->getStyle('G'.($inicio).':G'.($inicio+3))->applyFromArray($this->estiloTabla());
            //-------------------------------------------------------------
            //-----------------------GENERAL-----------------------------
            $sheet->setAutoSize(['D', 'E', 'F', 'G']);
            $sheet->setWidth('A', 14);
            $sheet->setWidth('B', 8.43);
            $sheet->setWidth('C', 8.43);
            $cb = $sheet->getColumnDimension('B')->getWidth();
            $cc = $sheet->getColumnDimension('C')->getWidth();
            $cd = $sheet->getColumnDimension('D')->getWidth();
            $ce = $sheet->getColumnDimension('E')->getWidth();
            $cf = $sheet->getColumnDimension('F')->getWidth();
            $cg = $sheet->getColumnDimension('G')->getWidth();
            $ctotal = intval(floor($cb + $cc + $cd + $ce + $cf + $cg));
                    
            $sheet->getStyle('B4')->getAlignment()->setWrapText(true);
            $sheet->setHeight(4, $this->altoFila($this->descripcion, $ctotal));
            // Set top, right, bottom, left
            $sheet->setPageMargin(array(
                0.75, 0.70, 0.75, 0.70
            ));
        });
    }

    public function altoFila($texto, $cAncho=8.43, $alto=15){
        $caracteres = strlen($texto);
        
        return intval($alto * ceil($caracteres / $cAncho));
    }

    public function darFormatoTablaExcel($filas, $inicio, $arr, $sheet){
        for ($i=0; $i < $filas; $i++) { 
            $descripcion = $arr[$i+2][0];
            $alto = $this->altoFila($descripcion, 30.86);
            $sheet->setHeight($inicio + $i, $alto);
            $sheet->mergeCells('A'.($i + $inicio).':C'.($i + $inicio));
            $sheet->getStyle('A'.($i + $inicio))->getAlignment()->setWrapText(true);
        }
    }

    public function estiloEncabezado(){
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

    public function estiloTabla(){
        return array(
            'borders' => array(
                'allborders' => array(
                    'style' => 'thin',
                ),
            )
        );
    }

     public function estiloTotales(){
        return array(
            'font' => array(
                'bold' => true,
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => 'thin',
                ),
            )
        );
    }

    public function getEquiposForExcel(){
        $campos = ['DESCRIPCIÓN', '', '', 'CANTIDAD', 'COSTO/HR', 'RENDIMIENTO', 'TOTAL'];
        $a = array(['EQUIPOS'], $campos);

        foreach ($this->equipos as $equipo) {
            $total = sprintf('%.2f', round($equipo->pivot->cantidad * $equipo->pivot->costo_hora2 * $equipo->pivot->rendimiento , 2));
            $fila = [$equipo->descripcion, '', '', $equipo->pivot->cantidad, $equipo->pivot->costo_hora2, $equipo->pivot->rendimiento, $total];
            array_push($a, $fila);
        }
        array_push($a, ['', '', '', '', '', 'SUBTOTAL', sprintf('%.2f', $this->totalEquipo())]);
        return $a;
    }

    public function getManoObForExcel(){
        $campos = ['DESCRIPCIÓN', '', '', 'CANTIDAD', 'JORNAL/HR', 'RENDIMIENTO', 'TOTAL'];
        $a = array(['MANO DE OBRA'], $campos);

        foreach ($this->manoDeObra as $mano) {
            $total = sprintf('%.2f', round($mano->pivot->cantidad * $mano->pivot->costo_hora2 * $mano->pivot->rendimiento , 2));
            $fila = [$mano->descripcion, '', '', $mano->pivot->cantidad, $mano->pivot->costo_hora2, $mano->pivot->rendimiento, $total];
            array_push($a, $fila);
        }
        array_push($a, ['', '', '', '', '', 'SUBTOTAL', sprintf('%.2f', $this->totalManoDeObra())]);
        return $a;
    }

    public function getMaterialesForExcel(){
        $campos = ['DESCRIPCIÓN', '', '', 'UNIDAD', 'COSTO', 'CANTIDAD', 'TOTAL'];
        $a = array(['MATERIALES'], $campos);

        foreach ($this->materiales as $material) {
            $total = sprintf('%.2f', round($material->pivot->cantidad * $material->pivot->costo2, 2));
            $fila = [$material->descripcion, '', '', $material->unidad, $material->pivot->costo2, $material->pivot->cantidad, $total];
            array_push($a, $fila);
        }
        array_push($a, ['', '', '', '', '', 'SUBTOTAL', sprintf('%.2f', $this->totalMateriales())]);
        return $a;
    }

    public function getTransportesForExcel(){
        $campos = ['DESCRIPCIÓN', '', '', 'UNIDAD', 'COSTO/KM', 'DISTANCIA(KM)', 'TOTAL'];
        $a = array(['TRANSPORTES'], $campos);

        foreach ($this->transportes as $transporte) {
            $total = sprintf('%.2f', round($transporte->pivot->cantidad * $transporte->pivot->costo_km2, 2));
            $fila = [$transporte->descripcion, '', '', $transporte->unidad, $transporte->pivot->costo_km2, $transporte->pivot->cantidad, $total];
            array_push($a, $fila);
        }
        array_push($a, ['', '', '', '', '', 'SUBTOTAL', sprintf('%.2f', $this->totalTransportes())]);
        return $a;
    }
}
