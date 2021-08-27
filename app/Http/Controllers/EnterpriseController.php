<?php

namespace App\Http\Controllers;

use App\Enterprise;
use App\Traits\FileImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

/**
 * Controller of 'Empresas'
 */
class EnterpriseController extends Controller
{
    use FileImage;

    public function show($id)
    {
        $enterprise = Enterprise::findOrFail($id);

        return response()->json([
            'data' => $enterprise
        ], Response::HTTP_FOUND);
    }

    public function updateImageBackground(Request $request, $id)
    {
        $enterprise = Enterprise::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'image_enterprise' => 'image',
        ],[], [
            'image_enterprise' => 'imagen de la empresa',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ]);
        }

        if ($request->hasFile('image_enterprise')) {

            $this->deleteImage($enterprise->ruta_fondo, 'enterprises');

            $ruta_fondo = $this->uploadImageAndGetUrl($request, 'enterprises', 'image_enterprise');

            $enterprise->update([
                'ruta_fondo' => $ruta_fondo
            ]);

            return response()->json([
                'data' => $enterprise,
                'message' => '!Cambio de imagen exitosamente!'
            ], Response::HTTP_OK);
        }
    }

    public function updateImageContent(Request $request, $id)
    {
        $enterprise = Enterprise::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'image_enterprise' => 'image',
        ],[], [
            'image_enterprise' => 'imagen de la empresa',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ]);
        }

        if ($request->hasFile('image_enterprise')) {

            $this->deleteImage($enterprise->ruta_small_2, 'enterprises');

            $ruta_small_2 = $this->uploadImageAndGetUrl($request, 'enterprises', 'image_enterprise');

            $enterprise->update([
                'ruta_small_2' => $ruta_small_2,
                'ruta_large_2' => $ruta_small_2
            ]);

            return response()->json([
                'data' => $enterprise,
                'message' => '!Cambio de imagen exitosamente!'
            ], Response::HTTP_OK);
        }
    }

}
