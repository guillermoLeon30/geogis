<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MaterialRequest;
use App\Models\Material;
use Carbon\Carbon;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', new Material());

        $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
        $page = $request->page;

        $materiales = Material::buscar($filtro)->paginate(5);
        
        if ($request->ajax()) {
            return response()->json(view('items.materiales.index.include.tabla', ['materiales'=>$materiales])->render());
        }

        return view('items.materiales.index.index', ['materiales'=>$materiales]);
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
    public function store(MaterialRequest $request)
    {
        $this->authorize('create', new Material());

        $material = new Material($request->all());
        $material->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha);
        $material->save();

        return response()->json(['mensaje' => 'Se ingresó correctamnte el regitro.']);
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
    public function edit($id)
    {
        $this->authorize('update', new Material());

        $material = Material::findOrFail($id);
        $material->fecha = $material->fecha();

        return response()->json(['material' => $material]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MaterialRequest $request, $id)
    {
        $this->authorize('update', new Material());

        $material = Material::findOrFail($id);
        $material->fill($request->all());
        $material->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha);
        $material->save();

        return response()->json(['mensaje' => 'Se actualizó correctamnte el regitro.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', new Material());
        
        $material = Material::findOrFail($id);
        $material->delete();

        return response()->json(['mensaje' => 'Se eliminó correctamnte el regitro.']);
    }

    public function excel()
    {
        Material::excel();
    }
}
