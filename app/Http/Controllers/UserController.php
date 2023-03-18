<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Método de autenticación para ingresar a este controlador
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Consulta de todos los usuarios con cualquier rol
        $users = User::select('users.*', 'roles.name as role_name')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_has_roles.model_type', '=', 'App\Models\User')
            ->get();

        return view('modules.users.index', ['users' => $users]);
    }



    public function edit(User $user)
    {
        return view('modules.users.edit', compact('user'));
    }

    // Funcion para desactivar el usuario

    public function desactivarUsuario($id)
    {
        $user = User::findOrFail($id);

        if ($user->state_record == 'ACTIVAR') {
            $user->state_record = 'DESACTIVAR';
        } else {
            $user->state_record = 'ACTIVAR';
        }

        $user->save();

        return redirect()->back();
    }


    // public function update(Request $request, $id)
    // {
    //     $user = User::find($id);

    //     $user->name = $request->input('name');
    //     $user->last_name = $request->input('last_name');
    //     $user->phone_number = $request->input('phone_number');
    //     $user->identification_type = $request->input('identification_type');
    //     $user->identification_number = $request->input('identification_number');
    //     $user->email = $request->input('email');
    //     if (!is_null($request->input('password'))) {
    //         $user->password = Hash::make($request->input('password'));
    //     }
    //     $user->age = $request->input('age');
    //     $user->save();

    //     return redirect()->route('users.index')->with('success', 'User updated successfully.');
    // }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'identification_number' => 'required|string|max:50|unique:users,identification_number,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->phone_number = $request->input('phone_number');
        $user->identification_type = $request->input('identification_type');
        $user->identification_number = $request->input('identification_number');
        $user->email = $request->input('email');
        if (!is_null($request->input('password'))) {
            $user->password = Hash::make($request->input('password'));
        }
        $user->age = $request->input('age');
        $user->save();
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function showCreate()
    {
        return view('modules.users.create');
    }

    public function create(Request $request)
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone_number' => 'required|string|max:255',
            'identification_type' => 'required|string|max:255',
            'identification_number' => 'required|string|max:255|unique:users',
            'age' => 'required|integer',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:cliente,admin'
        ]);

        // Verificar el valor de la opción seleccionada en el formulario
        if ($data['role'] == 'admin') {
            $role = 'admin';
        } else {
            $role = 'cliente';
        }

        $user = User::firstOrCreate([
            'email' => $data['email'],
            'identification_number' => $data['identification_number']
        ], [
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'phone_number' => $data['phone_number'],
            'identification_type' => $data['identification_type'],
            'age' => $data['age'],
            'password' => Hash::make($data['password']),
            'role' => $role,
            'state_record' => 'ACTIVAR',
            // 'create_time' => now(),
            // 'update_time' => now()
        ])->assignRole($role);

        return redirect()->route('users.index')->with('success', 'User create successfully.');
    }

    public function show(User $user)
    {
        $user = User::select('users.*', 'roles.name as role_name')
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('model_has_roles.model_type', '=', 'App\Models\User')
            ->where('users.id', '=', $user->id)
            ->first();

        return view('modules.users.show', compact('user'));
    }

}
?>
