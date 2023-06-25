<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use Illuminate\Http\Request;
use Auth;

class EditorController extends Controller
{
    public function index() {
        return view('upload.editor');
    }

    public function save(Request $form) {
        //dd($form);
        $arquivo = $form->input('editordata');
        $nome = $form->input('nomedata');
        $doc = [
            'nome' => $nome,
            'texto' => $arquivo,
            'createBy' => Auth::id(),
        ];
        // error_log(Auth::id());
        //Grava com nome aleatorio
        //$arquivo->store('public');
        //dd($arquivo);
        Document::create($doc);

        // Grava com nome original
        // $arquivo->storeAs('public', $arquivo->getClientOriginalName());

        return redirect('documents')->with('sucesso', 'Item adicionado com sucesso 👍');

    }

    public function editarGravar(Request $request)
    {
        $dados = $request->validate([
            'id' => 'required',
            'nomedata' => 'required',
            'editordata' => 'required',
        ]);

        $documento = Document::findOrFail($dados['id']);
        $documento->nome = $dados['nomedata'];
        $documento->texto = $dados['editordata'];
        $documento->save();

        return redirect('documents')->with('sucesso', 'Documento alterado com sucesso 👍');
    }


    public function editar(Document $documents) {
        return view('documents.editor', [
            'documents' => $documents,
        ]);
    }
}
