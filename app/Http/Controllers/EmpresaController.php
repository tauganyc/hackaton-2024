<?php

namespace App\Http\Controllers;

use App\Models\Conta;
use App\Models\Investimento;
use App\Models\Proposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EmpresaController extends Controller
{
    public function index()
    {
        if (!Gate::any(['empresa'])) {
            return redirect()->back()->with('error', 'Você não tem permissão para visualizar propostas');
        }
        $user =  Auth::user();
        $propostas = $user->propostas;

        return view('empresa.index', ['propostas' => $propostas, 'user' => $user]);
    }

    public function show($id)
    {
        $user =  Auth::user();
        if (!Gate::any(['empresa'])) {
            return redirect()->route('company')->with('error', 'Você não tem permissão para visualizar propostas');
        }
        $proposta = $user->propostas()->where('id', $id)->first();
        if (!$proposta) {
            return redirect()->back()->with('error', 'Proposta não encontrada');
        }
        $investimentos = Investimento::where('proposta_id', $proposta->id)->sum('valor');
        $investidores = Investimento::join('users', 'users.id', '=', 'investimentos.user_id')->where('proposta_id', $proposta->id)->groupBy('users.id')->select('users.name')->get();

        return view('empresa.show', ['proposta' => $proposta, 'user' => $user, 'investimentos' => $investimentos, 'investidores' => $investidores]);
    }
    public function create()
    {
        if (!Gate::any(['empresa'])) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar propostas');
        }
        $user =  Auth::user();
        return view('empresa.create');
    }
    public function store(Request $request)
    {
        if (!Gate::any(['empresa'])) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar propostas');
        }
        $request->validate([
            'titulo' => 'required',
            'descricao' => 'required',
            'valor' => 'required|min:0',
        ],
        [
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute deve ser maior que :min',
        ]
        );
        $user =  Auth::user();
        $proposta = Proposta::create(
            [
                'user_id' => $user->id,
                'titulo' => $request->input('titulo'),
                'descricao' => $request->input('descricao'),
                'valor' => $request->input('valor'),
            ]
        );

        return redirect()->route('company')->with('success', 'Proposta criada com sucesso');
    }
    public function withdraw(Request $request){
        if (!Gate::any(['empresa'])) {
            return redirect()->back()->with('error', 'Você não tem permissão para finalizar propostas');
        }
        $request->validate([
            'proposta_id' => 'required|exists:propostas,id',
        ],
            [
                'required' => 'O campo :attribute é obrigatório',
                'exists' => 'Proposta não encontrada'
            ]
        );
        $user = Auth::user();
        $proposta = Proposta::find($request->proposta_id);
        if ($proposta->user_id != $user->id) {
            return redirect()->back()->with('error', 'Você pode finalizar apenas suas próprias propostas');
        }
        $investimentos = Investimento::where('proposta_id', $proposta->id)->sum('valor');
        if ($investimentos != $proposta->valor) {
            return redirect()->back()->with('error', 'A proposta ainda não pode ser finalizada');
        }

        $user->saldo += $proposta->valor;
        $user->save();
        Conta::create(
            [
                'user_id' => $user->id,
                'valor' => $proposta->valor,
                'type' => 'proposta',
                'proposta_id' => $proposta->id,
            ]
        );
        $proposta->status = 'finalizada';
        $proposta->save();
        return redirect()->back()->with('success', 'Proposta finalizada com sucesso');
    }
}
