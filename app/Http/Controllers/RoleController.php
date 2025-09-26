<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $texto = $request->input('texto'); // Obtener el valor del campo de 
        $registros = Role::with('permissions')
            ->where('name', 'like', "%{$texto}%")
            ->orderBy('id', 'desc')
            ->paginate(2);

        return view('role.index', compact('registros', 'texto'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('role.action', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array'
        ]);

        $registro = Role::create(['name' => $request->name]);
        $registro->syncPermissions($request->permissions);
        

        return redirect()->route('roles.index')->with('mensaje', 'Rol' .$registro->name. 'creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $registro = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('role.action', compact('registro', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $registro = Role::findOrFail($id);
        $request->validate([
            'name' => 'required|unique:roles,name,' . $registro->id,
            'permissions' => 'required|array'
        ]);
        $registro->update(['name' => $request->name]);
        $registro->syncPermissions($request->permissions);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
