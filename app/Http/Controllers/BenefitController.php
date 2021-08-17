<?php

namespace App\Http\Controllers;

use App\Benefit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class BenefitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showViewOfBenefitByEnterprises($id)
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('benefits.index', compact('id','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validation($request);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $benefit = Benefit::create($request->all());

        return response()->json([
            'data' => $benefit,
            'message' => "!Beneficio creado exitosamente!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $benefit = Benefit::findOrFail($id);

        return response()->json([
            'data' => $benefit
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
        $benefit = Benefit::findOrFail($id);

        $validator = $this->validation($request);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $benefit->update($request->all());

        return response()->json([
            'data' => $benefit,
            'message' => "!Beneficio actualizado exitosamente!"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $benefit = Benefit::findOrFail($id);
        $benefit->delete();
        return $benefit;
    }

    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'descripcion' => 'required'
        ]);
        return $validator;
    }

    public function findAllBenefitsByEnterprise($id) {
        $benefits = Benefit::where('beneficios.empresa_id', $id)
                            ->orderBy('beneficios.descripcion', 'ASC')
                            ->get();
        return DataTables::of($benefits)
            ->addColumn('actions', 'benefits.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }
}
