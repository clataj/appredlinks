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
        ]);

        if($validator->fails()) {
            return response()->json([
                'type' => 'validate',
                'errors' => $validator->errors()
            ]);
        }

        if($request->hasFile('image_category')) {
            $file = $request->file('image_category');
            $token = sha1(time());
            $nameFile = $file->getClientOriginalName();
            $nameReplace = Str::replaceArray($nameFile, [$token], $nameFile);
            Storage::disk('public')->put('categories'.'/'.$nameReplace.'.'.$file->extension(), File::get($file));
            $category = Category::create([
                'nombre' => $request->name,
                'ruta_img' => config('app.url').'/storage/categories/'.$nameReplace.'.'.$file->extension(),
                'estado' => $request->status
            ]);

            return response()->json([
                'data' => $category,
                'message' => '!Categoria creada exitosamente!'
            ], Response::HTTP_CREATED);
        }

    }
}
