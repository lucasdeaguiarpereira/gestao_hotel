<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacotes;


class PacotesController extends Controller
{
    public function index() {
        return Pacotes::all();
    }

    public function store(Request $request)
    {
        Pacotes::create($request->all());
    }

    public function show($id)
    {
        return Pacotes::findOrFail($id);
    }
   
    public function update(Request $request, $id)
    {
        $usuario = Pacotes::findOrFail($id);
        $usuario->update($request->all());
    }

    public function destroy($id)
    {
        $usuario = Pacotes::findOrFail($id);
        $usuario->delete();
    }
}
