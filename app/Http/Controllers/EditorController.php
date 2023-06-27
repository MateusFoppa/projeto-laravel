<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class EditorController extends Controller
{
    public function index()
    {
        return view('upload.editor');
    }

    public function save(Request $form)
    {
        //dd($form);
        $rtx = '.rtx';
        $arquivo = $form->input('editordata');
        $nome = $form->input('nomedata');
        $doc = [
            'nome' => $nome . $rtx,
            'texto' => $arquivo,
            'createBy' => FacadesAuth::id(),
        ];

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


    public function editar(Document $documents)
    {
        // dd($documents);
        $extensao = ".rtx";

        // Obtém a parte final
        $final = substr($documents->nome, -strlen($extensao));

        // Verifica se a parte final
        if ($final === $extensao) {
            return view('documents.editor', [
                'documents' => $documents,
            ]);
        } else {
            return redirect('documents')->with('erro', 'Documento não é editável');
        }
    }
}
