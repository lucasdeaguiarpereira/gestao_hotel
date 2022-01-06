<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index() {
        return User::where('valido',1)->get();
    }

    public function store(Request $request)
    {
        $senhaCripto = Hash::make($request['password']);
        $request['password']  = $senhaCripto;
        User::create($request->all());
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }
   
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $senhaCripto = Hash::make($request['password']);
        $request['password']  = $senhaCripto;
        $usuario->update($request->all());
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
    }
}
