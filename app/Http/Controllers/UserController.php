<?php

namespace App\Http\Controllers;

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

    /**
     * This method will get data of an user by id
     * @param int $id id of user
     * @return JsonResponse data of user in format JSON
     */
    public function show(int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        return response()->json([
            'data' => $user
        ], Response::HTTP_FOUND);
    }

    /**
     * This method will save data of an user
     * @param Request $request
     * @return JsonResponse data of the created user in format JSON
     */
    public function store(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'password_confirmation' => 'required|same:password',
        ], [], [
            'name' => 'nombre',
            'email' => 'correo electrónico',
            'password' => 'contraseña',
            'password_confirmation' => 'confirmación de contraseña'
        ]);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'data' => $user,
            'message' => 'Usuario creado exitosamente'
        ], Response::HTTP_CREATED);
    }

    /**
     * This method will update data of an user
     * @param Request $request
     * @param int $id id of the user
     * @return JsonResponse data of the updated user in format JSON
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ],[], [
            'name' => 'nombre',
            'email' => 'correo electrónico',
        ]);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $user->update($request->all());

        return response()->json([
            'data' => $user,
            'message' => 'Usuario actualizado exitosamente'
        ], Response::HTTP_CREATED);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
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
