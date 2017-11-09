<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProyectoRequest;
use App\Models\Proyecto;

class ProyectoController extends Controller
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

        $proyectos = Proyecto::buscar($filtro)->paginate(5);

        if ($request->ajax()) {
            return response()
                ->json(view('proyecto.index.include.tabla', ['proyectos' => $proyectos])->render());
        }

        return view('proyecto.index.index', ['proyectos' => $proyectos]);
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
    public function store(ProyectoRequest $request)
    {
        DB::beginTransaction();

        try {
            Proyecto::guardar($request->all());   
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Proyecto $proyecto, Request $request)
    {
        $categoria = (isset($request->categoria) && !empty($request->categoria))?$request->categoria:'';
        $usuario = (isset($request->usuario) && !empty($request->usuario))?$request->usuario:'';

        if ($request->ajax() && $request->tabla == 'categoria') {
            $page = $request->pageCategoria;
            $categorias = $proyecto->buscarCategorias($categoria)->paginate(5, ['*'], 'page', $page);

            return response()
                ->json(view('proyecto.edit.include.tablaCategorias', ['categorias' => $categorias])->render());
        }

        if ($request->ajax() && $request->tabla == 'permisos') {
            $page = $request->pagePermisos;
            $usuarios = $proyecto->buscarUsuarios($usuario)->paginate(5, ['*'], 'page', $page);

            return response()
                ->json(view('proyecto.edit.include.tablaPermisos', ['usuarios' => $usuarios])->render());
        }

        $categorias = $proyecto->buscarCategorias($categoria)->paginate(5);
        $usuarios = $proyecto->buscarUsuarios($usuario)->paginate(5);

        return view('proyecto.edit.edit', ['proyecto' => $proyecto, 
                                           'categorias' => $categorias,
                                           'usuarios' => $usuarios]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProyectoRequest $request, Proyecto $proyecto)
    {
        if ($request->info == 'datos') {
            $proyecto->actualizarDatos($request->all());

            return response()->json(['mensaje' => 'Se actualizó correctamente el registro.']);
        }

        if ($request->info == 'permisos' && Auth::User()->can('crearPermiso', $proyecto)) {
            DB::beginTransaction();
            try {
                $proyecto->actualizarPermisos($request->all());
                DB::commit();
                return response()->json(['mensaje' => 'Se ingreso correctamente el registro.']); 
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json([], 500);   
            }
        }

        if ($request->info == 'eliminarPermiso') {
            $proyecto->eliminarUsuario($request->user_id);
            return response()->json([], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto $proyecto)
    {
        $this->authorize('crearPermiso', $proyecto);
        DB::beginTransaction();
        try {
            $proyecto->eliminar();
            DB::commit();
            
            return response()->json(['mensaje' => 'Se ingreso correctamente el registro.']); 
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json([], 500);   
        }
    }

    public function excel(Proyecto $proyecto)
    {
        $proyecto->excel();
    }
}
