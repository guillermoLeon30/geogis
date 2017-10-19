<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RolRequest;
use App\Models\Rol;
use App\Models\Permiso;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', new Rol());

        $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
        $page = $request->page;

        $roles = Rol::buscar($filtro)->paginate(5);
        
        if ($request->ajax()) {
            return response()->json(view('usuarios.roles.index.include.roles', ['roles'=>$roles])->render());
        }

        return view('usuarios.roles.index.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new Rol());

        $permisos = Permiso::all();

        return view('usuarios.roles.create.create', ['permisos' => $permisos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolRequest $request)
    {
        $this->authorize('create', new Rol());

        DB::beginTransaction();

        try {
            $rol = Rol::create($request->rol);
            $rol->permisos()->attach($request->idPermiso);
            DB::commit();

            return response()->json(['mensaje'=>'Se ingreso correctamente el registro.']);
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
        $this->authorize('update', new Rol());

        $rol = Rol::findOrFail($id);
        $permisos = Permiso::all();

        return view('usuarios.roles.edit.edit', ['rol' => $rol, 'permisos' => $permisos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolRequest $request, $id)
    {
        $this->authorize('update', new Rol());

        DB::beginTransaction();

        try {
            $rol = Rol::findOrFail($id);
            $rol->fill($request->rol);
            $rol->save();
            $rol->permisos()->sync($request->idPermiso);
            DB::commit();

            return response()->json(['mensaje'=>'Se ingreso correctamente el registro.']);
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
        $this->authorize('delete', new Rol());

        DB::beginTransaction();

        try {
            $rol = Rol::findOrFail($id);
            $rol->permisos()->detach($rol->idsPermisos());
            $rol->delete();
            DB::commit();

            return response()->json(['mensaje'=>'Se eliminó correctamente el registro.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([], 500);    
        }
        

    }
}
