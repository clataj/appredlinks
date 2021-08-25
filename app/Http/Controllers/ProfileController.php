<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id
        ], [], [
            'name' => 'nombre',
            'email' => 'correo electrónico'
        ]);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user->update($request->all());

        return response()->json([
            'data' => $user,
            'message' => '!Perfil Actualizado!'
        ], Response::HTTP_OK);
    }

    public function updateCredentials(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validateCredentials = Validator::make($request->all(), [
            'password' => 'required',
            'newpassword' => 'required|string',
            'repassword' => 'required|same:newpassword',
        ], [
            'repassword.same' => 'La nueva contraseña y la verificación de la contraseña deben coincidir'
        ], [
            'password' => 'contraseña',
            'newpassword' => 'nueva contraseña',
            'repassword' => 'verificación de la contraseña'
        ]);

        if ($validateCredentials->fails()) {
            return redirect()->route('settings')->withErrors($validateCredentials->errors());
        }

        if (Hash::check($request->password, Auth::user()->password, ['rounds' => 10])) {
            $user->update([
                'password' => Hash::make($request->newpassword, ['rounds' => 10])
            ]);
            return redirect()->route('dashboard')->with('status', 'Datos actualizados correctamente');
        }
    }

}
