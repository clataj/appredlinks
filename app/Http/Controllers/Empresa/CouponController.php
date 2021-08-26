<?php

namespace App\Http\Controllers\Empresa;

use App\Coupon;
use App\Enterprise;
use App\Http\Controllers\Controller;
use App\Traits\FormatDate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    use FormatDate;

    public function create($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->enterprises->contains($id)) {
            $enterprise = Enterprise::findOrFail($id);
            return view('coupons.create', compact('id','enterprise','user'));
        }
        return redirect('/enterprises');
    }

    public function findAll($id)
    {
        $coupons = Coupon::where('empresa_id', $id)->orderBy('estado', 'ASC')->get();
        return DataTables::of($coupons)
            ->addColumn('empresa_id', function ($coupon) {
                return $coupon->enterprise->nombre_comercial;
            })
            ->addColumn('estado', function ($coupon) {
                return $coupon->state->nombre;
            })
            ->addColumn('fecha_inicio', function ($coupon) {
                return $this->convertStringToDate($coupon->fecha_inicio);
            })
            ->addColumn('fecha_fin', function ($coupon) {
                return $this->convertStringToDate($coupon->fecha_fin);
            })
            ->addColumn('actions', 'coupons.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }
}
