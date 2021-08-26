<?php

namespace App\Http\Controllers\Empresa;

use App\Category;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class EnterpriseController extends Controller
{
    public function index($id)
    {
        if(intval($id) === Auth::user()->id) {
            $categories = Category::all(['id','nombre']);
            return view('empresa.enterprises.index', compact('categories', 'id'));
        } else {
            return redirect()->route('users.enterprises.index', Auth::user()->id);
        }
    }

    public function findAll()
    {
        $user = User::findOrFail(Auth::user()->id);
        $enterprises = $user->enterprises;
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
                ->addColumn('coupons', function($enterprise){
                    return '<a
                            href="'. route("coupons.create", $enterprise->id) .'"
                            class="btn btn-success">
                            <i class="fas fa-gift"></i>
                            </a>';
                })
                ->addColumn('actions', 'enterprises.actions')
                ->addColumn('createBranchOffice', function($enterprise) {
                    return '<a
                            href="'. route("branchOffices.createBranchOffice", $enterprise->id) .'"
                            class="btn btn-success">
                            <i class="fas fa-save"></i>
                            </a>';
                })
                // ->addColumn('beneficios', function($enterprise) {
                //     return '<a
                //             href="'. route("benefits.create", $enterprise->id) .'"
                //             class="btn btn-success">
                //             <i class="fas fa-concierge-bell"></i>
                //             </a>';
                // })
                ->rawColumns(['actions', 'createBranchOffice', /*'beneficios',*/'coupons'])
                ->make(true);
    }
}
