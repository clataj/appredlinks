<?php

namespace App\Http\Controllers\Empresa;

use App\BranchOffice;
use App\City;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BranchOfficeController extends Controller
{
    public function showViewOfBranchOfficeByEnterprises($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        $cities = City::all();
        if($user->enterprises->contains($id)) {
            return view('empresa.branchOffice.index', compact('id','cities'));
        }
        return redirect()->route('users.enterprises.index', Auth::user()->id);
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
            ->addColumn('actions', 'empresa.branchOffice.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }

}
