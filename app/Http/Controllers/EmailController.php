<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{
    public function getEmail(Request $request)
    {
        // $texto = $request->texto;
        // $assunto = $request->assunto;
        // $destinatario = $request->destinatario;
        Mail::send('mail.emailserrabene',['conteudo' => $request->texto], function($m) use ($request){
            $m->from('serradobene@gmail.com', 'Serra do bene');
            $m->subject($request->assunto);
            $m->to($request->destinatario);
        });
    }
}