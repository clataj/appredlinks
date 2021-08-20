<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Traits\FormatDate;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
        $user = User::findOrFail(Auth::user()->id);
        return view('coupons.index', compact('user'));
    }

    public function create($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->enterprises->contains($id)) {
            return view('coupons.create', compact('id','user'));
        }
        return redirect('/enterprises');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        if(intval($request->cant_x_usua) > intval($request->num_cupon)) {
            return response()->json([
                'type' => 'validate',
                'errors' => [
                    'error' => 'La cantidad de cupones excede el limite del numero de cupones'
                ]
            ], Response::HTTP_BAD_REQUEST);
        }

        $coupon = Coupon::create([
            'empresa_id' => $request->empresa_id,
            'estado' => 2,
            'texto' => $request->texto,
            'num_cupon' => $request->num_cupon,
            'cant_x_usua' => $request->cant_x_usua,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'descripcion' => $request->descripcion
        ]);

        return response()->json([
            'data' => $coupon,
            'message' => "!Cupon creado éxitosamente!"
        ], Response::HTTP_CREATED);


    }

    public function show($id)
    {
        $coupon = Coupon::where('id', $id)->with(['enterprise'])->first();

        return response()->json([
            'data' => $coupon
        ], Response::HTTP_FOUND);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $validator = $this->validator($request);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        if(intval($request->cant_x_usua) > intval($request->num_cupon)) {
            return response()->json([
                'type' => 'validate',
                'errors' => [
                    'error' => 'La cantidad de cupones excede el limite del numero de cupones'
                ]
            ], Response::HTTP_BAD_REQUEST);
        }

        $coupon->update($request->all());

        return response()->json([
            'data' => $coupon,
            'message' => "!Cupon actualizado éxitosamente!"
        ], Response::HTTP_OK);
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

    public function validator(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'empresa_id' => 'required',
            'texto' => 'required',
            'num_cupon' => 'required|integer',
            'cant_x_usua' => 'required|integer',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'descripcion' => 'required'
        ], [], [
            'empresa_id' => 'la empresa',
            'texto' => 'nombre del cupon',
            'num_cupon' => 'numero de cupones',
            'cant_x_usua' => 'cantidad de cupones',
            'fecha_inicio' => 'fecha de inicio',
            'fecha_fin' => 'fecha de culminacion'
        ]);
        return $validator;
    }

    public function findAll($id = null)
    {
        if(Auth::user()->role_id == 1) {
            $coupons = Coupon::orderBy('estado', 'ASC')->get();
            return $this->printDataTable($coupons);
        }

        if(Auth::user()->role_id == 2) {
            $coupons = Coupon::where('empresa_id', $id)->orderBy('estado', 'ASC')->get();
            return $this->printDataTable($coupons);
        }


    }

    public function printDataTable($coupons)
    {
        return DataTables::of($coupons)
            ->addColumn('empresa_id', function ($coupon) {
                return $coupon->enterprise->nombre_comercial;
            })
            ->addColumn('estado', function ($coupon) {
                return $coupon->state->nombre;
            })
            ->addColumn('fecha_inicio', function ($coupon) {
                return FormatDate::convertStringToDate($coupon->fecha_inicio);
            })
            ->addColumn('fecha_fin', function ($coupon) {
                return FormatDate::convertStringToDate($coupon->fecha_fin);
            })
            ->addColumn('actions', 'coupons.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }
}
