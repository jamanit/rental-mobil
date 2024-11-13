<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\M_template;
use App\Models\M_contact_form;
use App\Models\M_service;

class HomeController extends Controller
{
    protected $menuService;

    public function __construct()
    {
        // 
    }

    public function index()
    {
        $templates = M_template::where('publication_status', 'Yes')->orderBy('id', 'desc')->limit(4)->get();
        $services  = M_service::orderBy('id', 'asc')->get();

        return view('home.V-index-home', compact('templates', 'services'));
    }

    public function send_contact_form(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'message' => 'required|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        M_contact_form::create($request->all());

        return response()->json(['message' => 'Pesan Anda telah berhasil terkirim!'], 200);
    }

    public function load_more_template(Request $request)
    {
        if ($request->ajax()) {
            $offset    = $request->input('offset', 0);
            $templates = M_template::with('template_type')->orderBy('id', 'desc')->skip($offset)->take(4)->get();

            foreach ($templates as $template) {
                $template->image              = Storage::url($template->image);
                $template->template_name      = $template->template_name;
                $template->template_type_name = $template->template_type->template_type_name;
                $template->price              = number_format($template->price);
                $template->percent_discount   = number_format($template->percent_discount);
                $template->total_amount       = number_format($template->total_amount);
                $template->example_url        = $template->example_url;
            }

            return response()->json($templates);
        }

        return response()->json([], 404);
    }
}
