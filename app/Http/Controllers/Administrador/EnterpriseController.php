<?php

namespace App\Http\Controllers\Administrador;

use App\Enterprise;
use App\Http\Controllers\Controller;
use App\Traits\FileImage;
use Illuminate\Http\Request;

class EnterpriseController extends Controller
{
    use FileImage;

    public function searchEnterprise(Request $request)
    {
        $enterprises = [];

        if ($request->has('q')) {
            $search = $request->q;
            $enterprises = Enterprise::select('empresas.id', 'empresas.nombre_comercial')
                ->where('tipo', 'LA')
                ->where('estado', 'A')
                ->where('limite_cupon', '>', 0)
                ->where('empresas.nombre_comercial', 'LIKE', "%$search%")
                ->orderBy('empresas.nombre_comercial', 'ASC')
                ->get();
        }
        return response()->json($enterprises);
    }

    public function destroy($id)
    {
        $enterprise = Enterprise::findOrFail($id);
        $this->deleteImage($enterprise->ruta_small_2, 'enterprises');
        $this->deleteImage($enterprise->ruta_fondo, 'enterprises');

        if(count($enterprise->users) > 0) {
            $enterprise->delete();
            $enterprise->users()->detach();
            return $enterprise;
        }

        $enterprise->delete();
        return $enterprise;
    }
}
