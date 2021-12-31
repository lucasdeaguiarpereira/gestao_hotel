<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamentos;

class AgendamentosController extends Controller
{
    public function index() {
        return Agendamentos::all();
    }

    public function store(Request $request)
    {
        Agendamentos::create($request->all());
        return Agendamentos::latest()->first();
    }

    public function show($id)
    {
        return Agendamentos::findOrFail($id);
    }
   
    public function update(Request $request, $id)
    {
        $usuario = Agendamentos::findOrFail($id);
        $usuario->update($request->all());
    }

    public function destroy($id)
    {
        $usuario = Agendamentos::findOrFail($id);
        $usuario->delete();
    }
}
