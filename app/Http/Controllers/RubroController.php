<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRubros;
use App\Models\Rubro;

class RubroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', new Rubro());

        $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
        $page = $request->page;

        $rubros = Rubro::buscar($filtro)->paginate(5);
        
        if ($request->ajax()) {
            return response()->json(view('rubros.catalogo.index.include.rubros', ['rubros'=>$rubros])->render());
        }

        return view('rubros.catalogo.index.index', ['rubros' => $rubros]);
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
    public function store(StoreRubros $request)
    {
        Rubro::create($request->all());

        return response()->json(['mensaje' => 'Se ingresó correctamente el registro.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rubro = Rubro::findOrFail($id);

        return response()->json(['rubro'=>$rubro]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRubros $request, $id)
    {
        $rubro = Rubro::findOrFail($id);
        $rubro->fill($request->all());
        $rubro->save();

        return response()->json(['mensaje'=>'Se actualizó correctamente el registro.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Rubro::destroy($id);
        $rubro = Rubro::findOrFail($id);
        $rubro->delete();

        return response()->json(['mensaje'=>'Se eliminó correctamente el registro']);
    }
}
