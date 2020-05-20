<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PracticaController extends Controller
{
    public function index() {
        return view('home');
    }

    public function store(Request $request) {
    	session(['conversacion' => json_decode($request->conversacion)]);
    }

    public function all(Request $request) {

    	$conversacion = session('conversacion') ? session('conversacion') : [];

       	return response()->json(['data' => $conversacion, 'status' => 200], 200);
    }
}
