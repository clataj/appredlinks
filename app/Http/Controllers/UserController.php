<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'data' => $user
        ], Response::HTTP_FOUND);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'password_confirmation' => 'required|same:password',
        ]);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ]);
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

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ]);
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
