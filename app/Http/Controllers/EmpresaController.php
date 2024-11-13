<?php

namespace App\Http\Controllers;

use App\Models\Investimento;
use App\Models\Proposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class EmpresaController extends Controller
{
    public function index()
    {
        $user =  Auth::user();
        if (!Gate::any(['empresa'])) {
            return redirect()->back()->with('error', 'Você não tem permissão para visualizar propostas');
        }
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

        return view('empresa.show', ['proposta' => $proposta, 'user' => $user, 'investimentos' => $investimentos]);
    }
    public function create()
    {
        $user =  Auth::user();
        if (!Gate::any(['empresa'])) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar propostas');
        }
        return view('empresa.create');
    }
    public function store(Request $request)
    {
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
        if (!Gate::any(['empresa'])) {
            return redirect()->back()->with('error', 'Você não tem permissão para criar propostas');
        }
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
}
