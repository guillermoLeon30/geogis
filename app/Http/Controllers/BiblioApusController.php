<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BiblioApusRequest;
use App\Http\Requests\UpdateBiblioApuRequest;
use App\Models\BibliotecaApus;


class BiblioApusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
        $page = $request->page;
        
        if (isset($request->fuente)) {
            $elementos = BibliotecaApus::selectores($request->fuente, $filtro);

            return response()->json(['elementos' => $elementos]);
        }

        $apus = BibliotecaApus::buscar($filtro)->paginate(5);

        if ($request->ajax()) {
            return response()
                ->json(view('biblioteca_apus.index.include.tabla', ['apus' => $apus])->render());
        }

        return view('biblioteca_apus.index.index', ['apus' => $apus]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('biblioteca_apus.create.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BiblioApusRequest $request)
    {
        DB::beginTransaction();

        try {
            BibliotecaApus::guardar($request->all());
            DB::commit();

            return response()->json(['mensaje' => 'Se ingreso correctamente el registro.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apu = BibliotecaApus::findOrFail($id);

        return view('biblioteca_apus.show.show', ['apu' => $apu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apu = BibliotecaApus::findOrFail($id);

        return view('biblioteca_apus.edit.edit', ['apu' => $apu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBiblioApuRequest $request, $id)
    {
        $apu = BibliotecaApus::findOrFail($id);
        DB::beginTransaction();

        try {
            BibliotecaApus::actualizar($request->all(), $apu);
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
    public function destroy($id)
    {
        $apu = BibliotecaApus::findOrFail($id);
        DB::beginTransaction();

        try {
            $apu->eliminar();
            DB::commit();

            return response()->json(['mensaje' => 'Se ingreso correctamente el registro.']);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([], 500);            
        }        
    }
}
