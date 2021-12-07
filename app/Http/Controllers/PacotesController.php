<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pacotes;


class PacotesController extends Controller
{
    public function index() {
        return Pacotes::latest('updated_at')->get();
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

    public function salvarImagem(Request $request)
    {
        
        // exit(var_dump($request->fileimagem));
        // Define o valor default para a variável que contém o nome da imagem 
        $nameFile = null;
        
        // Verifica se informou o arquivo e se é válido
        if ($request->hasFile('fileimagem') && $request->file('fileimagem')->isValid()) {
            
            // Define um aleatório para o arquivo baseado no timestamps atual
            // $name = uniqid(date('HisYmd'));
            $name = $request->nomeImagem;

            // Recupera a extensão do arquivo
            $extension = $request->fileimagem->extension();

            // Define finalmente o nome
            $nameFile = "{$name}";

            // Faz o upload:
            $upload = $request->fileimagem->move('assets', $nameFile);
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/categories/nomedinamicoarquivo.extensao

            // Verifica se NÃO deu certo o upload (Redireciona de volta)
            if ( !$upload )
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();

        }
    }
}
