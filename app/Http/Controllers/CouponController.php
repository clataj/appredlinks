<?php

namespace App\Http\Controllers;

use App\Coupon;
use App\Enterprise;
use App\Traits\FormatDate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    use FormatDate;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $enterprise = Enterprise::findOrFail($request->empresa_id);

        $validator = $this->validator($request);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        if(intval($request->cant_x_usua) > intval($enterprise->limite_cupon)) {
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
            'num_cupon' => $enterprise->limite_cupon,
            'cant_x_usua' => $request->cant_x_usua,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'descripcion' => $request->descripcion
        ]);

        $enterprise->update([
            'limite_cupon' => $enterprise->limite_cupon - 1
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

        if(intval($request->cant_x_usua) > intval($coupon->num_cupon)) {
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
            'cant_x_usua' => 'required|integer',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'descripcion' => 'required'
        ], [], [
            'empresa_id' => 'la empresa',
            'texto' => 'nombre del cupon',
            'cant_x_usua' => 'cantidad de cupones',
            'fecha_inicio' => 'fecha de inicio',
            'fecha_fin' => 'fecha de culminacion'
        ]);
        return $validator;
    }
}
