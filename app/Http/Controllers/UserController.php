<?php

namespace App\Http\Controllers;

use App\Enterprise;
use App\Role;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

/**
 * Controller of 'Users'
 */
class UserController extends Controller
{

    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        $roles = Role::all();
        $enterprises = Enterprise::where('tipo','LA')->where('estado','A')->get();
        return view('users.create', compact('roles','enterprises'));
    }

    /**
     * This method will get data of an user by id
     * @param int $id id of user
     * @return JsonResponse data of user in format JSON
     */
    public function show(int $id): JsonResponse
    {
        $user = User::findOrFail($id);
        if($user->role_id == 2) {
            $enterprises = $user->enterprises;
            return response()->json([
                'data' => $user,
                'enterprises' => $enterprises
            ], Response::HTTP_FOUND);
        }

        return response()->json([
            'data' => $user
        ], Response::HTTP_FOUND);

    }

    /**
     * This method will save data of an user
     * @param Request $request
     */
    public function store(Request $request)
    {
        if(intval($request->role_id) == 1) {
            $validator = Validator::make($request->all(),[
                'role_id' => 'required|not_in:0',
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string',
                'password_confirmation' => 'required|same:password',
            ], [], [
                'role_id' => 'rol',
                'name' => 'nombre',
                'email' => 'correo electrónico',
                'password' => 'contraseña',
                'password_confirmation' => 'confirmación de contraseña'
            ]);

            if($validator->fails()) {
                return back()->withErrors($validator->errors())->withInput($request->input());
            }

            $user = User::create([
                'role_id' => $request->role_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('dashboard')->with('status', '!Usuario registrado!');
        }

        if(intval($request->role_id) == 2) {
            $validateEnterprise = Validator::make($request->all(),[
                'enterprises' => 'required',
                'role_id' => 'required|not_in:0',
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string',
                'password_confirmation' => 'required|same:password',
            ], [], [
                'enterprises' => 'empresa',
                'role_id' => 'rol',
                'name' => 'nombre',
                'email' => 'correo electrónico',
                'password' => 'contraseña',
                'password_confirmation' => 'confirmación de contraseña'
            ]);

            if($validateEnterprise->fails()) {
                return back()->withErrors($validateEnterprise->errors());
            }

            $user = User::create([
                'role_id' => $request->role_id,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->enterprises()->sync($request->enterprises, false);
            return redirect()->route('dashboard')->with('status', '!Usuario registrado!');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $ids = $user->enterprises()->pluck('empresas.id')->toArray();
        $enterprises = Enterprise::where('tipo','LA')->where('estado', 'A')->get();
        $roles = Role::all();
        return view('users.edit', compact('user','roles', 'ids', 'enterprises'));
    }

    /**
     * This method will update data of an user
     * @param Request $request
     * @param int $id id of the user
     */
    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        if(intval($request->role_id) == 1) {

            $validator = Validator::make($request->all(), [
                'role_id' => 'required|not_in:0',
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,'.$user->id,
            ],[], [
                'role_id' => 'rol',
                'name' => 'nombre',
                'email' => 'correo electrónico',
            ]);

            if($validator->fails()) {
                return back()->withErrors($validator->errors());
            }

            if(count($user->enterprises) > 0) {
                $user->update([
                    'role_id' => $request->role_id,
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
                $user->enterprises()->detach();
            } else {
                $user->update([
                    'role_id' => $request->role_id,
                    'name' => $request->name,
                    'email' => $request->email,
                ]);
            }
            return redirect()->route('dashboard')->with('status', '!Usuario actualizado correctamente!');
        }

        if(intval($request->role_id) == 2) {
            $validateEnterprise = Validator::make($request->all(),[
                'enterprises' => 'required',
                'role_id' => 'required|not_in:0',
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,'.$user->id,
            ], [], [
                'enterprises' => 'empresa',
                'role_id' => 'rol',
                'name' => 'nombre',
                'email' => 'correo electrónico'
            ]);

            if($validateEnterprise->fails()) {
                return back()->withErrors($validateEnterprise->errors());
            }

            $user->update([
                'role_id' => $request->role_id,
                'name' => $request->name,
                'email' => $request->email,
            ]);

            $user->enterprises()->sync($request->enterprises);
            return redirect()->route('dashboard')->with('status', '!Usuario actualizado correctamente!');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if(count($user->enterprises) > 0) {
            $user->delete();
            $user->enterprises()->detach();
        }
        $user->delete();
        return $user;
    }

    public function findAll()
    {
        $users = User::all();
        return DataTables::of($users)
            ->addColumn('name', function ($user) {
                return $user->name;
            })
            ->addColumn('email', function ($user) {
                return $user->email;
            })
            ->addColumn('options', 'users.actions')
            ->rawColumns(['options'])
            ->make(true);
    }
}
