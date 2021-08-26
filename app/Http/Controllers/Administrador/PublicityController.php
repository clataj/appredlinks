<?php

namespace App\Http\Controllers\Administrador;

use App\Enterprise;
use App\Http\Controllers\Controller;
use App\Publicity;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PublicityController extends Controller
{
    public function index()
    {
        return view('publicities.index');
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
            ->addColumn('actions', 'publicities.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }
}
