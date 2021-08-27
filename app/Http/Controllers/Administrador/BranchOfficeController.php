<?php

namespace App\Http\Controllers\Administrador;

use App\BranchOffice;
use App\City;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class BranchOfficeController extends Controller
{
    public function showViewOfBranchOfficeByEnterprises($id)
    {
        $cities = City::all();
        return view('administrador.branchOffice.index', compact('id','cities'));
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
        ->addColumn('actions', 'administrador.branchOffice.actions')
        ->rawColumns(['actions'])
        ->make(true);

    }

}
