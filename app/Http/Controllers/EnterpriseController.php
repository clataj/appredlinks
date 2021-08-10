<?php

namespace App\Http\Controllers;

use App\Category;
use App\Enterprise;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class EnterpriseController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(Auth::user()->id);
        $categories = Category::all(['id','nombre']);
        return view('enterprises.index', compact('user','categories'));
    }

    public function findAll()
    {
        $enterprises = Enterprise::all();
        return DataTables::of($enterprises)->make(true);
    }
}
