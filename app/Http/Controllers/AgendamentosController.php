<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamentos;

class AgendamentosController extends Controller
{
    public function index() {
        return Agendamentos::orderBydesc("updated_at")->get();
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
        $agendamento = Agendamentos::findOrFail($id);
        $agendamento->update($request->all());
        return $agendamento;
    }

    public function destroy($id)
    {
        $agendamento = Agendamentos::findOrFail($id);
        $agendamento->delete();
    }
}
