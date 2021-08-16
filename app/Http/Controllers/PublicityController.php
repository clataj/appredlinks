<?php

namespace App\Http\Controllers;

use App\Enterprise;
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

    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('publicities.index', compact('user'));
    }

    public function store(Request $request)
    {
        $validator = $this->validation($request);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $imagen = FileImage::uploadImageAndGetUrl($request, 'publicities', 'imagen');

        $publicity = Publicity::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'estado' => $request->estado,
            'imagen' => $imagen,
            'sub_categoria' => $request->sub_categoria,
            'tipo' => $request->tipo
        ]);

        return response()->json([
            'data' => $publicity,
            'message' => "!Publicidad creada éxitosamente!"
        ], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $publicity = Publicity::where('id', $id)->with(['enterprise'])->first();

        return response()->json([
            'data' => $publicity
        ], Response::HTTP_FOUND);
    }

    public function update(Request $request, $id)
    {
        $publicity = Publicity::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required|date_format:Y-m-d',
            'fecha_fin' => 'required|date_format:Y-m-d',
            'estado' => 'required|string',
            'sub_categoria' => 'required|not_in:0',
            'tipo' => 'required|string'
        ], [], [
            'fecha_inicio' => 'fecha de inicio',
            'fecha_fin' => 'fecha de culminación',
            'sub_categoria' => 'de la empresa',
        ]);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $publicity->update($request->all());

        return response()->json([
            'data' => $publicity,
            'message' => "!Publicidad actualizada éxitosamente!"
        ], Response::HTTP_OK);

    }

    public function updateImage(Request $request, $id)
    {
        $publicity = Publicity::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'imagen' => 'image',
        ],[], [
            'imagen' => 'imagen de la publicidad',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ]);
        }

        if($request->hasFile('imagen')) {

            FileImage::deleteImage($publicity->imagen, 'publicities');

            $imagen = FileImage::uploadImageAndGetUrl($request, 'publicities', 'imagen');

            $publicity->update([
                'imagen' => $imagen
            ]);

            return response()->json([
                'data' => $publicity,
                'message' => '!Cambio de imagen exitosamente!'
            ], Response::HTTP_OK);
        }

    }

    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required|date_format:Y-m-d',
            'fecha_fin' => 'required|date_format:Y-m-d',
            'estado' => 'required|not_in:0',
            'imagen' => 'image',
            'sub_categoria' => 'required|not_in:0',
            'tipo' => 'required|not_in:0'
        ], [], [
            'fecha_inicio' => 'fecha de inicio',
            'fecha_fin' => 'fecha de culminación',
            'sub_categoria' => 'de la empresa',
        ]);
        return $validator;
    }

    public function searchEnterprise(Request $request)
    {
        $enterprises = [];

        if ($request->has('q')) {
            $search = $request->q;
            $enterprises = Enterprise::select('empresas.id', 'empresas.nombre_comercial')
                ->where('tipo', 'LA')
                ->where('estado', 'A')
                ->where('empresas.nombre_comercial', 'LIKE', "%$search%")
                ->orderBy('empresas.nombre_comercial', 'ASC')
                ->get();
        }
        return response()->json($enterprises);
    }

    public function findAll()
    {
        $publicities = Publicity::where('tipo', 'P')
            ->orWhere('tipo','C')
            ->orderBy('tipo', 'DESC')
            ->get();
        return DataTables::of($publicities)
            ->addColumn('tipo', function($publicity) {
                return $publicity->tipo==='P' ? 'Publicidad Destacada' : 'Publicidad Secundaria';
            })
            ->addColumn('estado', function($publicity) {
                return $publicity->estado=='A' ? 'Activo' : 'Inactivo';
            })
            ->addColumn('sub_categoria', function($publicity) {
                return $publicity->enterprise->nombre_comercial;
            })
            ->addColumn('actions', 'publicities.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }
}
