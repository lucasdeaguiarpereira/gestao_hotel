<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index() {
        return User::all();
    }

    public function store(Request $request)
    {
        User::create($request->all());
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }
   
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->update($request->all());
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
    }
}
