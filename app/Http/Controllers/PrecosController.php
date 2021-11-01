<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Precos;


class PrecosController extends Controller
{
    public function index() {
        return Precos::all();
    }

    public function store(Request $request)
    {
        Precos::create($request->all());
    }

    public function show($id)
    {
        return Precos::findOrFail($id);
    }
   
    public function update(Request $request, $id)
    {
        $usuario = Precos::findOrFail($id);
        $usuario->update($request->all());
    }

    public function destroy($id)
    {
        $usuario = Precos::findOrFail($id);
        $usuario->delete();
    }
}
