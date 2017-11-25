<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EquipoRequest;
use App\Models\Equipo;
use Carbon\Carbon;

class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', new Equipo());

        $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
        $page = $request->page;

        $equipos = Equipo::buscar($filtro)->paginate(5);
        
        if ($request->ajax()) {
            return response()->json(view('items.equipos.index.include.equipos', ['equipos'=>$equipos])->render());
        }

        return view('items.equipos.index.index', ['equipos' => $equipos]);
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
    public function store(EquipoRequest $request)
    {
        $this->authorize('create', new Equipo());

        $equipo = new Equipo($request->all());
        $equipo->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha);
        $equipo->save();
        
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
    public function edit(Equipo $equipo)
    {
        $this->authorize('update', new Equipo());

        $equipo->fecha = $equipo->fecha();
        return response()->json(['equipo' => $equipo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EquipoRequest $request, Equipo $equipo)
    {
        $this->authorize('update', new Equipo());

        $equipo->fill($request->all());
        $equipo->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha);
        $equipo->save();

        return response()->json(['mensaje' => 'Se actualizó correctamnte el regitro.']);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipo $equipo)
    {
        $this->authorize('delete', new Equipo());
        
        $equipo->delete();
        
        return response()->json(['mensaje' => 'Se eliminó correctamnte el regitro.']);
    }

    public function excel()
    {
        $this->authorize('descargar', Equipo::class);
        Equipo::excel();
    }
}
