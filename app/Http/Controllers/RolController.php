<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//agregamos
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\DB;


class RolController extends Controller
{
    function __construct()
    {   //Agregamos los permisos que hemos definido 
        $this->middleware('permission:ver-rol|crear-rol|editar-rol|borrar-rol|Usuario-rol|Administrador-rol', ['only' => ['index']]);
        $this->middleware('permission:crear-rol', ['only' => ['create','store']]);
        $this->middleware('permission:editar-rol', ['only' => ['edit','update']]);
        $this->middleware('permission:borrar-rol', ['only' => ['destroy']]);

        $this->middleware('permission:borrar-pedidos', ['only' => ['destroy']]);

      //$this->middleware('permission:ver-pedidos|crear-pedidos|editar-pedidos|borrar-pedidos|Usuario-rol|Administrador-rol"', ['only' => ['index']]);
     // $this->middleware('permission:agregar-pedidos', ['only' => ['create', 'store']]);
     // $this->middleware('permission:editar-pedidos', ['only' => ['edit','update']]);
      //$this->middleware('permission:borrar-pedidos', ['only' => ['destroy']]);


        // Asignar permisos específicos al rol de alumno
        $usuario =  Role::where(['name' => 'Usuario']);

       // $usuario->syncPermissions(['ver-rol','crear-rol', 'editar-rol','borrar-rol', 'Usuario-rol', 'ver-pedidos', 'crear-pedidos', 'editar-pedidos', 'borrar-pedidos']);
        //$usuario->syncPermissions(['ver-rol','crear-rol', 'editar-rol','borrar-rol', 'Usuario-rol']);

        $usuarioRole = Role::findByName('Usuario');
        $administradorRole = Role::findByName('Administrador');
        
        
       
 
   }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {        
         //Con paginación
         $roles = Role::paginate(5);
         return view('roles.index',compact('roles'));
         //al usar esta paginacion, recordar poner en el el index.blade.php este codigo  {!! $roles->links() !!} 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::get();
        return view('roles.crear',compact('permission')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
    
        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission'));
    
        return redirect()->route('roles.index');                        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('roles.editar',compact('role','permission','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{
    $this->validate($request, [
        'name' => 'required',
        'permission' => 'required',
    ]);

    // Find the role by ID
    $role = Role::find($id);

    // Check if the role exists
    

    // Update the role properties
    $role->name = $request->input('name');
    $role->save();

    // Sync the permissions
    $role->syncPermissions($request->input('permission'));

    return redirect()->route('roles.index')->with('success', 'Role updated successfully');
}


    public function show($id) {
        $role = Role::find($id);
        return redirect()->route('roles.index', compact('role'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index');                        
    }
}
