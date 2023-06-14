<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstoqueRequest;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentsController extends Controller
{
    public function index()
    {
        $lista = Document::orderBy('id', 'desc')->get();

        return view('documents.index', [
            'lista' => $lista,
        ]);
    }

    public function busca (Request $form) {
        $busca = $form->busca;
        $lista = Document::where('nome', 'LIKE', "%{$busca}%")->get();

        return view('documents.index', ['lista' => $lista, ]);
    }

    public function adicionar()
    {
        return view('estoque.adicionar');
    }

    public function adicionarGravar(EstoqueRequest $form)
    {
        $dados = $form->validated();
        Document::create($dados);
        return redirect('estoque')->with('sucesso', 'Item adicionado com sucesso 👍');
    }

    public function editarGravar(Document $form)
    {
        $dados = $form->validated();
        $estoque = Document::find($dados['id']);
        $estoque->fill($dados);
        $estoque->save();
        return redirect('documents')->with('sucesso', 'Item alterado com sucesso 👍');
    }

    public function editar(Document $document) {
        return view('documents.editor', [
            'editor' => $document,
        ]);
    }

    public function apagar (Document $document) {
        if (request()->isMethod('DELETE')) {
            $document->delete();
            return redirect('documents')->with('sucesso', 'Item apagado com sucesso 👍');
        }

        return view('documents.apagar', [
            'document' => $document
        ]);
    }
}
