<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use App\Publicity;
use App\Traits\FileImage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class PublicityController extends Controller
{
    use FileImage;

    public function index($id)
    {
        if(intval($id) === Auth::user()->id) {
            $user = User::where('id', $id)->with(['enterprises.publicities'])->first();
            $enterprises = $user->enterprises;
            $enterprise = null;

            if(count($user->enterprises) == 1) {
                $enterprise = $user->enterprises[0];
            }
            return view('empresa.publicities.index', compact('id','enterprises','enterprise'));
        } else {
            return redirect()->route('publicities.enterprise.index', Auth::user()->id);
        }
    }

    public function store(Request $request)
    {

        $date = date('Y-m-d');

        $validator = $this->validation($request);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $imagen = $this->uploadImageAndGetUrl($request, 'publicities', 'imagen');

        $publicity = Publicity::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $date,
            'fecha_fin' => date('Y-m-d', strtotime($date."+ 1 year")),
            'estado' => 'P',
            'imagen' => $imagen,
            'sub_categoria' => $request->sub_categoria,
            'tipo' => $request->tipo
        ]);

        return response()->json([
            'data' => $publicity,
            'message' => "!Publicidad creada éxitosamente, esta en revision!"
        ], Response::HTTP_CREATED);
    }

    public function update(Request $request, $id) {

        $publicity = Publicity::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'sub_categoria' => 'required|not_in:0',
            'tipo' => 'required|string'
        ], [], [
            'sub_categoria' => 'de la empresa',
        ]);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $publicity->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'sub_categoria' => $request->sub_categoria,
            'tipo' => $request->tipo
        ]);

        return response()->json([
            'data' => $publicity,
            'message' => "!Publicidad actualizad éxitosamente!"
        ], Response::HTTP_CREATED);
    }

    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'imagen' => 'image',
            'sub_categoria' => 'required|not_in:0',
            'tipo' => 'required|not_in:0'
        ], [], [
            'sub_categoria' => 'de la empresa',
        ]);
        return $validator;
    }

    public function findAll($id)
    {
        $user = User::where('id', $id)->with(['enterprises.publicities'])->first();

        foreach ($user->enterprises as $enterprise) {
            return DataTables::of($enterprise->publicities)
                ->addColumn('tipo', function($publicity) {
                    return $publicity->tipo==='P' ? 'Publicidad Destacada' : 'Publicidad Secundaria';
                })
                ->addColumn('estado', function($publicity) {
                    if($publicity->estado == 'A') {
                        return 'Activo';
                    }
                    if($publicity->estado == 'I') {
                        return 'Inactivo';
                    }
                    return 'En Revision';
                })
                ->addColumn('sub_categoria', function($publicity) {
                    return $publicity->enterprise->nombre_comercial;
                })
                ->addColumn('actions', 'empresa.publicities.actions')
                ->rawColumns(['actions'])
                ->make(true);
        }
    }
}
