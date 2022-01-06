<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agendamentos;
use App\Models\User;
use App\Models\Precos;
use App\Models\Pacotes;
use Illuminate\Support\Facades\DB;



class RelatoriosController extends Controller
{
    public function getFaturamentoTotal($dataInicial,$dataFinal) {
        $agendamentos = DB::table('agendamentos')
                        ->join('precos', 'precos.id_agendamento', '=', 'agendamentos.id')
                        ->where('status',2)
                        ->where('valido',1)
                        ->where('data_inicio', '>=', $dataInicial)
                        ->where('data_fim', '<=', $dataFinal)
                        ->orderBy("data_inicio","asc")
                        ->get();

        return $agendamentos;
    }

}
