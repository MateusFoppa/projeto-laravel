<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstoqueRequest;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

class DocumentsController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // Obtém o ID do usuário logado
        $lista = Document::where('createby', $userId)->get(); // Recupera os documentos do usuário logado

        return view('documents.index', [
            'lista' => $lista,
        ]);
    }



    public function compartilhar(Request $request, $id)
    {
        // Obtenha o documento com base no ID fornecido
        $documento = Document::find($id);

        // Verifique se o documento existe
        if (!$documento) {
            abort(404); // Ou retorne uma resposta adequada caso o documento não seja encontrado
        }

        // Obtenha a lista de usuários selecionados
        $usuariosSelecionados = $request->input('usuarios', []);

        // Realize as ações de compartilhamento com os usuários selecionados
        foreach ($usuariosSelecionados as $usuarioId) {
            // Verifique se o usuário existe
            $usuario = User::find($usuarioId);

            if ($usuario) {
                // Verifique se o documento já está compartilhado com o usuário
                $compartilhamentoExistente = $documento->usuarios()->where('user_id', $usuarioId)->exists();

                if (!$compartilhamentoExistente) {
                    // Compartilhe o documento com o usuário
                    $documento->usuarios()->attach($usuarioId);

                    // Obtenha as permissões selecionadas para o usuário
                    $permissoes = $request->input('permissions.' . $usuarioId, []);
                    dd($permissoes);
                    // Armazene as permissões do usuário em relação ao documento
                    $permissionsData = [];
                    foreach ($permissoes as $permissao) {
                        $permissionsData[$permissao] = true;
                    }
                    $documento->usuarios()->updateExistingPivot($usuarioId, ['permissions' => $permissionsData]);
                }
            }
        }

        // Redirecione para uma página de sucesso ou exiba uma mensagem adequada
        return redirect()->route('documents')->with('success', 'Documento compartilhado com sucesso.');
    }



    public function compartilhados()
    {
        // Obtenha o ID do usuário logado
        $userId = auth()->id();

        // Obtenha os documentos compartilhados com o usuário logado
        $documentos = Document::whereHas('usuarios', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with(['usuarios' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->get();
        // dd($documentos);
        return view('documents.compartilhados', ['documentos' => $documentos]);
    }




    public function busca(Request $form)
    {
        $busca = $form->busca;
        $lista = Document::where('nome', 'LIKE', "%{$busca}%")->get();

        return view('documents.index', ['lista' => $lista,]);
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

    public function editar(Document $dados)
    {

        return view('documents.editor', [
            'documents' => $dados,
        ]);
    }

    public function apagar(Document $document)
    {
        if (request()->isMethod('DELETE')) {
            $document->delete();
            return redirect('documents')->with('sucesso', 'Item apagado com sucesso 👍');
        }

        return view('documents.apagar', [
            'document' => $document
        ]);
    }
}
