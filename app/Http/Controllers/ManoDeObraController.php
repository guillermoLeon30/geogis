<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ManoDeObraRequest;
use App\Models\ManoDeObra;
use Carbon\Carbon;

class ManoDeObraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', new ManoDeObra());

        $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
        $page = $request->page;

        $ManoDeObras = ManoDeObra::buscar($filtro)->paginate(5);
        
        if ($request->ajax()) {
            return response()->json(view('items.mano_de_obra.index.include.tabla', ['ManoDeObras'=>$ManoDeObras])->render());
        }

        return view('items.mano_de_obra.index.index', ['ManoDeObras'=>$ManoDeObras]);
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
    public function store(ManoDeObraRequest $request)
    {
        $this->authorize('create', new ManoDeObra());

        $ManoDeObra = new ManoDeObra($request->all());
        $ManoDeObra->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha);
        $ManoDeObra->save();

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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ManoDeObra $ManoDeObra)
    {
        $this->authorize('update', $ManoDeObra);

        $ManoDeObra->fecha = $ManoDeObra->fecha();

        return response()->json(['ManoDeObra' => $ManoDeObra]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ManoDeObraRequest $request, ManoDeObra $ManoDeObra)
    {
        $this->authorize('update', $ManoDeObra);

        $ManoDeObra->fill($request->all());
        $ManoDeObra->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha);
        $ManoDeObra->save();

        return response()->json(['mensaje' => 'Se actualizó correctamnte el regitro.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManoDeObra $ManoDeObra)
    {
        $this->authorize('delete', $ManoDeObra);
        
        $ManoDeObra->delete();

        return response()->json(['mensaje' => 'Se eliminó correctamnte el regitro.']);
    }

    public function excel()
    {
        $this->authorize('descargar', ManoDeObra::class);
        ManoDeObra::excel();
    }
}
