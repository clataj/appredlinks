<?php

namespace App\Http\Controllers;

use App\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

/**
 * Controller of 'Categorias'
 */
class CategoryController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        return view('categories.index', compact('user'));
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
            $file = $request->file('image_category');
            $token = sha1(time());
            $nameFile = $file->getClientOriginalName();
            $nameReplace = Str::replaceArray($nameFile, [$token], $nameFile);
            Storage::disk('public')->put('categories' . '/' . $nameReplace . '.' . $file->extension(), File::get($file));
            $category = Category::create([
                'nombre' => $request->name,
                'ruta_img' => config('app.url') . '/storage/categories/' . $nameReplace . '.' . $file->extension(),
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
            'status' => 'required|string|not_in:0'
        ],[], [
            'name' => 'nombre',
            'status' => 'estado'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'request' => $request->all(),
                'type' => 'validate',
                'errors' => $validator->errors()
            ]);
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

            $fileOld = basename($category->ruta_img);

            Storage::disk('public')->delete('categories'.'/'.$fileOld);

            $file = $request->file('image_category');
            $token = sha1(time());
            $nameFile = $file->getClientOriginalName();
            $nameReplace = Str::replaceArray($nameFile, [$token], $nameFile);

            Storage::disk('public')->put('categories' . '/' . $nameReplace . '.' . $file->extension(), File::get($file));

            $category->update([
                'ruta_img' => config('app.url') . '/storage/categories/' . $nameReplace . '.' . $file->extension(),
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
        $fileOld = basename($category->ruta_img);
        Storage::disk('public')->delete('categories'.'/'.$fileOld);
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
            ->addColumn('actions', 'categories.actions')
            ->rawColumns(['actions'])
            ->make(true);
    }
}
