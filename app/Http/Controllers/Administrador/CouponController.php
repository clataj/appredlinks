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
        return view('administrador.coupons.index');
    }

    public function disabled($id)
    {
        $coupon = Coupon::findOrFail($id);

        $coupon->update([
            'estado' => 5
        ]);

        return $coupon;

    }

    public function enabled($id)
    {
        $coupon = Coupon::findOrFail($id);

        $coupon->update([
            'estado' => 2
        ]);

        return $coupon;
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
            ->addColumn('actions', 'administrador.coupons.actions')
            ->rawColumns(['actions'])
            ->make(true);

    }
}
