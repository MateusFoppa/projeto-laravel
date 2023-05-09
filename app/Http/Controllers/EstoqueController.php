<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstoqueRequest;
use App\Models\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function index()
    {
        $lista = Estoque::orderBy('id', 'desc')->get();

        return view('estoque.index', [
            'lista' => $lista,
        ]);
    }

    public function adicionar()
    {
        return view('estoque.adicionar');
    }

    public function adicionarGravar(EstoqueRequest $form)
    {
        $dados = $form->validated();
        Estoque::create($dados);
        return redirect('estoque');
    }

    public function editarGravar(EstoqueRequest $form)
    {
        $dados = $form->validated();
        $estoque = Estoque::find($dados['id']);
        $estoque->fill($dados);
        $estoque->save();
        return redirect('estoque');
    }

    public function editar(Estoque $estoque) {
        return view('estoque.adicionar', [
            'editar' => $estoque,
        ]);
    }
}
