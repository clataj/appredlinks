<?php

namespace App\Http\Controllers;

use App\BranchOffice;
use App\City;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

/**
 * Controller of 'Sucursales'
 */
class BranchOfficeController extends Controller
{
    public function showViewOfBranchOfficeByEnterprises($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        $cities = City::all();
        return view('branchOffice.index', compact('id','user','cities'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'ciudad_id' => 'required|not_in:0',
            'estado' => 'required|not_in:0',
            'qr' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'latitud_map' => 'required',
            'longitud_map' => 'required'
        ],[],[
            'nombre' => 'nombre de la sucursal',
            'ciudad_id' => 'ciudad',
            'latitud_map' => 'latitud del mapa',
            'longitud_map' => 'longitud del mapa'
        ]);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $branchOffice = BranchOffice::create($request->all());

        return response()->json([
            'data' => $branchOffice,
            'message' => '!Sucursal creada exitosamente!'
        ], Response::HTTP_CREATED);
    }

    public function findAllBranchOfficeByEnterprise($id) {
        $branchOffices = BranchOffice::where('sucursales.empresa_id', $id)
                            ->orderBy('sucursales.nombre', 'ASC')
                            ->get();
        return DataTables::of($branchOffices)
            ->addColumn('city', function($branchOffice) {
                return $branchOffice->city->ciudDesc;
            })
            ->addColumn('status', function($branchOffice) {
                return $branchOffice->estado=='A' ? 'Activo' : 'Inactivo';
            })
            ->addColumn('actions', 'branchOffice.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }
}
