<?php

namespace App\Http\Controllers\Administrador;

use App\Category;
use App\Http\Controllers\Controller;
use App\Traits\FileImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    use FileImage;

    public function index()
    {
        return view('administrador.categories.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image_category' => 'image',
            'status' => 'required|string|not_in:0'
        ], [], [
            'name' => 'nombre',
            'image_category' => 'imagen de la categoria',
            'status' => 'estado'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        if ($request->hasFile('image_category')) {

            $ruta_img = $this->uploadImageAndGetUrl($request, 'categories', 'image_category');

            $category = Category::create([
                'nombre' => $request->name,
                'ruta_img' => $ruta_img,
                'estado' => $request->status
            ]);

            return response()->json([
                'data' => $category,
                'message' => '!Categoria creada exitosamente!'
            ], Response::HTTP_CREATED);
        }
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response()->json([
            'data' => $category
        ], Response::HTTP_FOUND);
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'status' => 'required|not_in:0'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        }

        $category->update([
            'nombre' => $request->name,
            'estado' => $request->status
        ]);

        return response()->json([
            'data' => $category,
            'message' => '!Categoria actualizada exitosamente!'
        ], Response::HTTP_OK);
    }

    public function updateImage(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'image_category' => 'image',
        ],[], [
            'image_category' => 'imagen de la categoria',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ]);
        }

        if ($request->hasFile('image_category')) {

            $this->deleteImage($category->ruta_img, 'categories');

            $ruta_img = $this->uploadImageAndGetUrl($request, 'categories', 'image_category');

            $category->update([
                'ruta_img' => $ruta_img,
            ]);

            return response()->json([
                'data' => $category,
                'message' => '!Cambio de imagen exitosamente!'
            ], Response::HTTP_OK);
        }
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $this->deleteImage($category->ruta_img, 'categories');
        $category->delete();
        return $category;
    }

    public function findAll()
    {
        $categories = Category::all();

        return DataTables::of($categories)
            ->addColumn('name', function ($category) {
                return $category->nombre;
            })
            ->addColumn('status', function ($category) {
                return $category->estado === 'A' ? 'Activo' : 'Inactivo';
            })
            ->addColumn('actions', 'administrador.categories.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }
}
