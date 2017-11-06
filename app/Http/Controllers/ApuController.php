<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ApuRequest;
use App\Http\Requests\ApuUpdateRequest;
use App\Models\Apu;

class ApuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
        $elementos = Apu::selectores($request->fuente, $filtro);

        return response()->json(['elementos' => $elementos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApuRequest $request)
    {
        Apu::create($request->all());

        return response()->json([], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apu $apu)
    {
        return view('proyecto.categoria.apu.edit.edit', ['apu' => $apu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApuUpdateRequest $request, Apu $apu)
    {
        $this->authorize('editar', $apu->categoria->proyecto);
        DB::beginTransaction();

        try {
            $apu->actualizar($request->all());
            DB::commit();

            return response()->json(['mensaje' => 'Se ingreso correctamente el registro.']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apu $apu)
    {
        $this->authorize('editar', $apu->categoria->proyecto);
        DB::beginTransaction();

        try {
            $apu->eliminar();
            $total = $apu->categoria->total();
            DB::commit();

            return response()->json(['mensaje'  =>  'Se ingreso correctamente el registro.',
                                     'total'    =>  $total]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([], 500);
        }    
    }

    public function exportarExcel(Apu $apu)
    {
        $apu->excel();
    }
}