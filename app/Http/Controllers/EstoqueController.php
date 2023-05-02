<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function index() {
        $lista = Estoque::orderBy('id', 'desc')->get();
        
        return view('estoque.index', [
            'lista' => $lista,
        ]);
    }

    public function adicionar(Request $form) {
        // Verifica se é POST para gravar no banco
        if ($form->method() == 'POST') {
            $dados = $form->validate([
                'nome' => 'required',
                'quantidade' => 'required',
            ]);

            Estoque::create($dados);

            return redirect('estoque');
        }

        return view('estoque.adicionar');
        # Podemos também utilizar / para separar pasta e arquivo
        # return view('estoque/adicionar');
    }
}
