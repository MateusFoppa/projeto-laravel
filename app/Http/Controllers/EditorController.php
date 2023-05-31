<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

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
        ];
        //Grava com nome aleatorio
        //$arquivo->store('public');
        //dd($arquivo);
        Document::create($doc);

        // Grava com nome original
        // $arquivo->storeAs('public', $arquivo->getClientOriginalName());

        return 'Gravado!';
    }
}
