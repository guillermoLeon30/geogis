<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CategoriaRequest;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(CategoriaRequest $request)
    {
        Categoria::create($request->all());

        return response()->json(['mensaje' => 'Se ingreso correctamente el registro.']);
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
    public function edit($id, Request $request)
    {
        $categoria = Categoria::findOrFail($id);

        $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
        $page = $request->page;

        $apus = $categoria->buscarApus($filtro)->paginate(5);

        if ($request->ajax()) {
            return response()->json(view('proyecto.categoria.edit.include.tabla', 
                ['apus' => $apus])->render());
        }
        
        return view('proyecto.categoria.edit.edit', ['categoria' => $categoria, 'apus' => $apus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoriaRequest $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->actualizarDatos($request->all());

        return response()->json(['mensaje' => 'Se ingreso correctamente el registro.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $this->authorize('editar', $categoria->proyecto);
        DB::beginTransaction();

        try {
            $categoria->eliminar();
            $total = $categoria->proyecto->total();
            DB::commit();

            return response()->json(['mensaje'  =>  'Se ingreso correctamente el registro.',
                                     'total'    =>  $total]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([], 500);
        }    
    }
}
