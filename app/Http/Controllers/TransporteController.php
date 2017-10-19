<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransporteRequest;
use App\Models\Transporte;
use Carbon\Carbon;

class TransporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', new Transporte());

        $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
        $page = $request->page;

        $transportes = Transporte::buscar($filtro)->paginate(5);
        
        if ($request->ajax()) {
            return response()->json(view('items.transportes.index.include.tabla', ['transportes'=>$transportes])->render());
        }

        return view('items.transportes.index.index', ['transportes'=>$transportes]);
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
    public function store(TransporteRequest $request)
    {
        $this->authorize('create', new Transporte());

        $transporte = new Transporte($request->all());
        $transporte->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha);
        $transporte->save();

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
    public function edit(Transporte $transporte)
    {
        $this->authorize('update', $transporte);
           
        $transporte->fecha = $transporte->fecha();

        return response()->json(['transporte' => $transporte]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TransporteRequest $request, Transporte $transporte)
    {
        $this->authorize('update', $transporte);

        $transporte->fill($request->all());
        $transporte->fecha = Carbon::createFromFormat('d/m/Y', $request->fecha);
        $transporte->save();

        return response()->json(['mensaje' => 'Se actualizó correctamnte el regitro.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transporte $transporte)
    {
        $this->authorize('delete', $transporte);
        
        $transporte->delete();

        return response()->json(['mensaje' => 'Se eliminó correctamnte el regitro.']);
    }
}
