<?php

namespace App\Http\Controllers;

use App\Category;
use App\Enterprise;
use App\Traits\FileImage;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

/**
 * Controller of 'Empresas'
 */
class EnterpriseController extends Controller
{
    use FileImage;

    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        $categories = Category::all(['id','nombre']);
        return view('enterprises.index', compact('user','categories'));
    }

    public function show($id)
    {
        $enterprise = Enterprise::findOrFail($id);

        return response()->json([
            'data' => $enterprise
        ], Response::HTTP_FOUND);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'ruc' => 'required',
            'razon_social' => 'required',
            'beneficio' => 'required',
            'nombre_comercial' => 'required',
            'categoria_id' => 'required|not_in:0',
            'direccion' => 'required',
            'telefono' => 'required',
            'estado' => 'required|string|not_in:0',
            'ruta_fondo' => 'image',
            'ruta_small_2' => 'image'
        ], [], [
            'name' => 'nombre',
            'razon_social' => 'razón social',
            'nombre_comercial' => 'nombre comercial',
            'categoria_id' => 'categoria',
            'ruta_fondo' => 'imagen de fondo',
            'ruta_small_2' => 'imagen del contenido'
        ]);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        if($request->hasFile('ruta_fondo') && $request->hasFile('ruta_small_2')){
            $ruta_fondo = FileImage::uploadImageAndGetUrl($request, 'enterprises', 'ruta_fondo');
            $ruta_small_2 = FileImage::uploadImageAndGetUrl($request, 'enterprises', 'ruta_small_2');

            $enterprise = Enterprise::create([
                'ruc' => $request->ruc,
                'razon_social' => $request->razon_social,
                'beneficio' => $request->beneficio,
                'nombre_comercial' => $request->nombre_comercial,
                'categoria_id' => $request->categoria_id,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'correo' => $request->correo,
                'twitter' => $request->twitter,
                'facebook' => $request->facebook,
                'instagram' => $request->instagram,
                'website' => $request->website,
                'tipo' => 'LA',
                'estado' => $request->estado,
                'ruta_small_2' => $ruta_small_2,
                'ruta_large_2' => $ruta_small_2,
                'ruta_fondo' => $ruta_fondo
            ]);

            return response()->json([
                'data' => $enterprise,
                'message' => '!Empresa creada exitosamente!'
            ], Response::HTTP_CREATED);
        }
    }

    public function update(Request $request, $id)
    {
        $enterprise = Enterprise::findOrFail($id);

        $validator = Validator::make($request->all(),[
            'ruc' => 'required',
            'razon_social' => 'required',
            'beneficio' => 'required',
            'nombre_comercial' => 'required',
            'categoria_id' => 'required|not_in:0',
            'direccion' => 'required',
            'telefono' => 'required',
            'estado' => 'required|string',
        ], [], [
            'name' => 'nombre',
            'razon_social' => 'razón social',
            'nombre_comercial' => 'nombre comercial',
            'categoria_id' => 'categoria',
        ]);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ]);
        }

        $enterprise->update($request->all());

        return response()->json([
            'data' => $enterprise,
            'message' => 'Empresa actualizada correctamente'
        ], Response::HTTP_OK);
    }

    public function updateImageBackground(Request $request, $id)
    {
        $enterprise = Enterprise::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'image_enterprise' => 'image',
        ],[], [
            'image_enterprise' => 'imagen de la empresa',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ]);
        }

        if ($request->hasFile('image_enterprise')) {

            FileImage::deleteImage($enterprise->ruta_fondo, 'enterprises');

            $ruta_fondo = FileImage::uploadImageAndGetUrl($request, 'enterprises', 'image_enterprise');

            $enterprise->update([
                'ruta_fondo' => $ruta_fondo
            ]);

            return response()->json([
                'data' => $enterprise,
                'message' => '!Cambio de imagen exitosamente!'
            ], Response::HTTP_OK);
        }
    }

    public function updateImageContent(Request $request, $id)
    {
        $enterprise = Enterprise::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'image_enterprise' => 'image',
        ],[], [
            'image_enterprise' => 'imagen de la empresa',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ]);
        }

        if ($request->hasFile('image_enterprise')) {

            FileImage::deleteImage($enterprise->ruta_small_2, 'enterprises');

            $ruta_small_2 = FileImage::uploadImageAndGetUrl($request, 'enterprises', 'image_enterprise');

            $enterprise->update([
                'ruta_small_2' => $ruta_small_2,
                'ruta_large_2' => $ruta_small_2
            ]);

            return response()->json([
                'data' => $enterprise,
                'message' => '!Cambio de imagen exitosamente!'
            ], Response::HTTP_OK);
        }
    }

    public function destroy($id)
    {
        $enterprise = Enterprise::findOrFail($id);
        FileImage::deleteImage($enterprise->ruta_small_2, 'enterprises');
        FileImage::deleteImage($enterprise->ruta_fondo, 'enterprises');
        $enterprise->delete();
        return $enterprise;
    }

    public function findAll()
    {
        if(Auth::user()->role_id == 1) {

            $enterprises = Enterprise::where('tipo','LA')->orderBy('estado', 'ASC');
            return $this->printDataTable($enterprises);

        }

        if(Auth::user()->role_id == 2) {
            $user = User::findOrFail(Auth::user()->id);
            $enterprises = $user->enterprises;
            return $this->printDataTable($enterprises);
        }
    }

    public function printDataTable($enterprises) {
        return DataTables::of($enterprises)
                ->addColumn('categoria_id', function($enterprise) {
                    return $enterprise->category->nombre;
                })
                ->addColumn('correo', function ($enterprise) {
                    return $enterprise->correo!=null ? $enterprise->correo : 'No dispone';
                })
                ->addColumn('website', function ($enterprise) {
                    return $enterprise->website!=null ? $enterprise->website : 'No dispone';
                })
                ->addColumn('facebook', function ($enterprise) {
                    return $enterprise->facebook!=null ? $enterprise->facebook : 'No dispone';
                })
                ->addColumn('twitter', function ($enterprise) {
                    return $enterprise->twitter!=null ? $enterprise->twitter : 'No dispone';
                })
                ->addColumn('instagram', function ($enterprise) {
                    return $enterprise->instagram!=null ? $enterprise->instagram : 'No dispone';
                })
                ->addColumn('estado', function ($enterprise) {
                    return $enterprise->estado === 'A' ? 'Activo' : 'Inactivo';
                })
                ->addColumn('actions', 'enterprises.actions')
                ->addColumn('createBranchOffice', function($enterprise) {
                    return '<a
                            href="'. route("branchOffices.createBranchOffice", $enterprise->id) .'"
                            class="btn btn-success">
                            <i class="fas fa-save"></i>
                            </a>';
                })
                ->addColumn('beneficios', function($enterprise) {
                    return '<a
                            href="'. route("benefits.create", $enterprise->id) .'"
                            class="btn btn-success">
                            <i class="fas fa-concierge-bell"></i>
                            </a>';
                })
                ->rawColumns(['actions', 'createBranchOffice', 'beneficios'])
                ->make(true);
    }
}
