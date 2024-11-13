<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContaController extends Controller
{
    public function index()
    {
        $user =  Auth::user()->load('contas');
        return view('conta.index', ['user' => $user]);
    }

    public function deposit(Request $request)
    {
        $request->validate([
            'valor' => 'required|min:0',
        ],
        [
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute deve ser maior que :min',
        ]
        );
        $user =  Auth::user();
        $conta = Conta::create(
            [
                'user_id' => $user->id,
                'valor' => $request->valor,
            ]
        );

        $user->saldo += $request->valor;
        $user->save();
        return redirect()->back()->with('success', 'Depósito realizado com sucesso');
    }
    public function withdraw(Request $request)
    {
        $request->validate([
            'valor' => 'required|min:0',
        ],
        [
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute deve ser maior que :min',
        ]
        );
        $user =  Auth::user();
        if ($user->saldo < $request->valor) {
            return redirect()->back()->with('error', 'Saldo insuficiente');
        }
        $conta = Conta::create(
            [
                'user_id' => $user->id,
                'valor' => $request->valor,
                'type' => 'saque',
            ]
        );

        $user->saldo -= $request->valor;
        $user->save();
        return redirect()->back()->with('success', 'Saque realizado com sucesso');
    }
}
