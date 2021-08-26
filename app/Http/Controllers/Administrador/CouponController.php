<?php

namespace App\Http\Controllers\Administrador;

use App\Coupon;
use App\Http\Controllers\Controller;
use App\Traits\FormatDate;
use Yajra\DataTables\Facades\DataTables;

class CouponController extends Controller
{
    use FormatDate;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('coupons.index');
    }

    public function findAll()
    {
        $coupons = Coupon::orderBy('estado', 'ASC')->get();
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
