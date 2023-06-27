<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstoqueRequest;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class DocumentsController extends Controller
{
    public function index()
    {
        $userId = FacadesAuth::id(); // Obtém o ID do usuário logado
        $lista = Document::where('createby', $userId)
            ->with('createdByUser') // Busca função da model documentos
            ->get();
        // dd($lista);
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
            abort(404);
        }

        // Obtenha a lista de usuários
        $usuariosSelecionados = $request->input('usuarios', []);

        foreach ($usuariosSelecionados as $usuarioId) {
            // Verifique se o usuário existe
            $usuario = User::find($usuarioId);

            if ($usuario) {
                // Verifique se o documento já está compartilhado com o usuário
                $compartilhamentoExistente = $documento->usuarios()->where('user_id', $usuarioId)->exists();

                // extesão filtrada
                $extensao = ".rtx";

                // Obtém a parte final
                $final = substr($documento->nome, -strlen($extensao));


                if (!$compartilhamentoExistente) {
                    // Compartilhe o documento com o usuário
                    $documento->usuarios()->attach($usuarioId);

                    // Obtenha as permissões selecionadas para o usuário
                    $permissoes = $request->input('permissions.' . $usuarioId, []);
                    // dd($permissoes);
                    // permissões do usuário em relação ao documento
                    $permissionsData = [];

                    // dd($permissoes);

                    foreach ($permissoes as $permissao) {
                        // Verifica se a parte final
                        if ($final === $extensao) {
                            // retira a opção view
                            $permissionsData['view'] = false;
                        }
                        $permissionsData[$permissao] = true;
                    }
                    $documento->usuarios()->updateExistingPivot($usuarioId, ['permissions' => $permissionsData]);
                } else {
                    // Obtenha as permissões selecionadas para o usuário
                    $permissoes = $request->input('permissions.' . $usuarioId, []);
                    // dd($permissoes);
                    // Armazene as permissões do usuário em relação ao documento
                    $permissionsData = [];
                    foreach ($permissoes as $permissao) {
                        // Verifica se a parte final
                        if ($final === $extensao) {
                            // retira a opção view
                            $permissionsData['view'] = false;
                        }
                        $permissionsData[$permissao] = true;
                    }
                    $documento->usuarios()->updateExistingPivot($usuarioId, ['permissions' => $permissionsData]);
                }
            }
        }

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
            $query->where('user_id', $userId)->withPivot('permissions');
        }])->get();
        //  dd($documentos);
        return view('documents.compartilhados', ['documentos' => $documentos]);
    }

    public function busca(Request $form)
    {
        $busca = $form->busca;
        $user = User::where('name', 'LIKE', "%{$busca}%")->first();

        $query = Document::where('nome', 'LIKE', "%{$busca}%");

        if ($user) {
            $query->orWhereHas('createdByUser', function ($query) use ($user) {
                $query->where('id', $user->id);
            });
        }

        // Verifica se a busca é uma data válida
        if (strtotime($busca)) {
            $query->orWhereDate('created_at', '=', $busca);
        }

        $lista = $query->get();

        return view('documents.index', ['lista' => $lista]);
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

    public function visualizarDocumento($id)
    {
        $documento = Document::find($id);

        if (!$documento) {
            return redirect('documents')->with('erro', 'Documento não encontrado.');
        }

        // Obtém o caminho completo do arquivo
        $filePath = storage_path('app/' . $documento->path);

        // Verifica se o arquivo existe
        if (!file_exists($filePath)) {
            return redirect('documents')->with('erro', 'Arquivo não encontrado.');
        }

        // Define o nome do arquivo para download
        $fileName = $documento->nome;

        // Define os cabeçalhos para o download
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        // Retorna a resposta de download
        return response()->download($filePath, $fileName, $headers);
    }
}
