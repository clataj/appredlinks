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

        if(Auth::user()->role_id == 2) {
            if($user->enterprises->contains($id)) {
                return view('branchOffice.index', compact('id','user','cities'));
            }
            return redirect('/enterprises');
        }

        return view('branchOffice.index', compact('id','user','cities'));
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

        $branchOffice = BranchOffice::create($request->all());

        return response()->json([
            'data' => $branchOffice,
            'message' => '!Sucursal creada exitosamente!'
        ], Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $branchOffice = BranchOffice::findOrFail($id);

        return response()->json([
            'data' => $branchOffice
        ], Response::HTTP_FOUND);
    }

    public function update(Request $request, $id)
    {
        $branchOffice = BranchOffice::findOrFail($id);

        $validator = $this->validation($request);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $branchOffice->update($request->all());

        return response()->json([
            'data' => $branchOffice,
            'message' => "!Sucursal actualizada exitosamente!"
        ]);
    }

    public function destroy($id)
    {
        $branchOffice = BranchOffice::findOrFail($id);
        $branchOffice->delete();
        return $branchOffice;
    }

    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'ciudad_id' => 'required|not_in:0',
            'estado' => 'required|string',
            'qr' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'latitud_map' => 'required',
            'longitud_map' => 'required',
            'dias_laborales' => 'required',
        ],[],[
            'dias_laborales' => 'horario de la semana',
            'nombre' => 'nombre de la sucursal',
            'ciudad_id' => 'ciudad',
            'latitud_map' => 'latitud del mapa',
            'longitud_map' => 'longitud del mapa'
        ]);
        return $validator;
    }

    public function findAllBranchOfficeByEnterprise($id) {
        $branchOffices = BranchOffice::where('sucursales.empresa_id', $id)
                            ->orderBy('sucursales.nombre', 'ASC')
                            ->get();

        return DataTables::of($branchOffices)
        ->addColumn('city', function($branchOffice) {
            return $branchOffice->city!=null ? $branchOffice->city->ciudDesc : 'Sin ciudad';
        })
        ->addColumn('status', function($branchOffice) {
            return $branchOffice->estado=='A' ? 'Activo' : 'Inactivo';
        })
        ->addColumn('dia_no_laboral_1', function($branchOffice) {
            return $branchOffice->dia_no_laboral_1!=null ? $branchOffice->dia_no_laboral_1 : 'Sin atencion';
        })
        ->addColumn('dia_no_laboral_2', function($branchOffice) {
            return $branchOffice->dia_no_laboral_2!=null ? $branchOffice->dia_no_laboral_2 : 'Sin atencion';
        })
        ->addColumn('actions', 'branchOffice.actions')
        ->rawColumns(['actions'])
        ->make(true);

    }
}
