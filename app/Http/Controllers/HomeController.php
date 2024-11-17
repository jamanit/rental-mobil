<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\M_mobil;

class HomeController extends Controller
{
    protected $menuService;

    public function __construct()
    {
        // 
    }

    public function index()
    {
        $mobil = M_mobil::orderBy('id', 'desc')->paginate(6);
        return view('home.V-index-home', compact('mobil'));
    }
}
