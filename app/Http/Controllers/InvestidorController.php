<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\Investimento;
use App\Models\Proposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class InvestidorController extends Controller
{
    public function index()
    {
        if (!Gate::any(['investidor'])){
            return redirect()->back()->with('error', 'Você não tem permissão para investir');
        }
        $user =  Auth::user();
        $propostas = Proposta::join('users','users.id', '=', 'propostas.user_id')->where('status','aberto')->select('propostas.*', 'users.name')->get();

        return view('investidor.index', ['user' => $user, 'propostas' => $propostas]);
    }
    public function show($id)
    {
        $user =  Auth::user();
        if (!Gate::any(['investidor'])) {
            return redirect()->back()->with('error', 'Você não tem permissão para isto');
        }
        $proposta = Proposta::find($id);
        if (!$proposta) {
            return redirect()->back()->with('error', 'Proposta não encontrada');
        }
        $investimentos = Investimento::where('proposta_id', $proposta->id)->sum('valor');

        $investidor_investiu = Investimento::where('proposta_id', $proposta->id)->where('user_id', $user->id)->sum('valor');

        return view('investidor.show', ['proposta' => $proposta, 'user' => $user, 'investimentos' => $investimentos, 'investidor_investiu' => $investidor_investiu]);
    }
    public function invest(Request $request){
        if (!Gate::any(['investidor'])) {
            return redirect()->back()->with('error', 'Você não tem permissão para investir');
        }
        $request->validate([
            'valor' => 'required|min:0',
            'proposta_id' => 'required|exists:propostas,id',
        ],
        [
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute deve ser maior que :min',
            'exists' => 'Proposta não encontrada'
        ]
        );
        $user = Auth::user();
        $proposta = Proposta::find($request->proposta_id);
        if (!$proposta) {
            return redirect()->back()->with('error', 'Proposta não encontrada');
        }
        if ($proposta->user_id == $user->id) {
            return redirect()->back()->with('error', 'Você não pode investir na sua própria proposta');
        }
        if ($user->saldo < $request->valor) {
            return redirect()->back()->with('error', 'Saldo insuficiente');
        }
        $investimentos = Investimento::where('proposta_id', $proposta->id)->sum('valor');
        if ($investimentos + $request->valor > $proposta->valor) {
            return redirect()->back()->with('error', 'Valor do investimento ultrapassa o valor da proposta');
        }

        $investimento = Investimento::create(
            [
                'user_id' => $user->id,
                'proposta_id' => $proposta->id,
                'valor' => $request->valor,
            ]
        );
        $user->saldo -= $request->valor;
        $user->save();
        Conta::create(
            [
                'user_id' => $user->id,
                'valor' => $request->valor,
                'type' => 'investimento',
                'proposta_id' => $proposta->id,
            ]
        );
        return redirect()->back()->with('success', 'Investimento realizado com sucesso');
    }
}
