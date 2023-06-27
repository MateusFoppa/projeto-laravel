<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    public function index() {
        return view('upload.index');
    }

    public function save2(Request $form) {
        //dd($form);
        $arquivo = $form->file('file');

        //Grava com nome aleatorio
        //$arquivo->store('public');

        //Grava com nome original
         $arquivo->storeAs('public', $arquivo->getClientOriginalName());

         return redirect('documents')->with('sucesso', 'Item adicionado com sucesso 👍');
    }

    public function save(Request $form)
    {
        $arquivo = $form->file('file');

        // Validação do tipo de arquivo
        $validExtensions = ['doc', 'docx', 'pdf'];
        $fileExtension = $arquivo->getClientOriginalExtension();

        if (!in_array($fileExtension, $validExtensions)) {
            return redirect('upload')->with('erro', 'Tipo de documento inválido. Apenas arquivos doc, docx e pdf são permitidos.');
        }

        // Define o diretório de armazenamento personalizado
        $diretorio = 'documentos';

        // Salva o arquivo no armazenamento com o nome original
        $path = $arquivo->storeAs($diretorio, $arquivo->getClientOriginalName());

        // Cria um novo documento
        $documento = new Document();
        $documento->nome = $arquivo->getClientOriginalName();
        $documento->path = $path;
        $documento->createby = Auth::id();
        $documento->texto = '';
        $documento->save();

        return redirect('documents')->with('sucesso', 'Documento adicionado com sucesso 👍');
    }
}
