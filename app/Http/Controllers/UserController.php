<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Requests\UserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\DeleteUserRequest;
use App\User;
use App\Models\Rol;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view', new User());
        
        $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
        $page = $request->page;
        //dd($request->all());
        if ($request->ajax() && $request->tipo = 'todos') {
            $id = User::idCreadorProyecto($request->idProyecto);
            $usuarios = User::buscar($filtro)->where('id', '!=', $id)->get()->take(20);
            return response()->json(['usuarios' => $usuarios]);
        }

        $usuarios = User::buscar($filtro)->paginate(5);
        
        if ($request->ajax()) {
            return response()->json(view('usuarios.lista.index.include.usuarios', ['usuarios'=>$usuarios])->render());
        }

        $roles = Rol::all();

        return view('usuarios.lista.index.index', ['usuarios' => $usuarios, 'roles' => $roles]);
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
    public function store(UserRequest $request)
    {
        $this->authorize('create', new User());

        DB::beginTransaction();

        try {
            $user = new User($request->all());
            $user->password = bcrypt($request->password);
            $user->save();
            $user->roles()->attach($request->tipo);
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
    public function edit($id)
    {
        $this->authorize('update', new User());

        $usuario = User::findOrFail($id);
        $roles = $usuario->rolesId();

        return response()->json(['usuario' => $usuario, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $this->authorize('update', new User());

        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);
            $user->estado = $request->estado;
            $user->save();
            $user->roles()->sync($request->tipo);
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
    public function destroy(Request $request, $id)
    {
        $this->authorize('delete', new User());
        
        DB::beginTransaction();

        try {
            $user = User::findOrFail($id);
            $user->roles()->detach($user->rolesId());
            $user->delete();
            DB::commit();

            return response()->json(['mensaje' => 'Se elimino correctamente el registro.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([], 500);
        }
    }
}
