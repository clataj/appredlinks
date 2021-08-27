<?php

namespace App\Http\Controllers;

use App\BranchOffice;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

/**
 * Controller of 'Sucursales'
 */
class BranchOfficeController extends Controller
{
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
}
