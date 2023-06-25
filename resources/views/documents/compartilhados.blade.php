@extends('base')

@section('title', 'Documents Compartilhados')

@section('content')

<!-- Listar os documentos compartilhados -->
<div class="mb-5">
    <table class="min-w-full divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Documento</th>
                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Usuário</th>
                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Ações</th>
            </tr>
        </thead>

        <tbody class=" bg-white divide-gray-200">
            @foreach ($documentos as $item)
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">{{$item['id']}}</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">{{$item['nome']}}</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">{{$item['createBy']}}</td>
                <td>
                @foreach ($item->usuarios as $usuario)
        <!-- Informações do usuário -->
            <textarea name="" id="" cols="30" rows="10">

                {{$usuario}}
            </textarea>
        <!-- Permissões do usuário para o documento -->
        @if ($usuario->pivot->permissions)
            <!-- Verifica se a permissão de visualização está definida -->
            @if ($usuario->pivot->permissions->view)
                <!-- Exibir conteúdo permitido para visualização -->
                <p>Conteúdo permitido para visualização</p>
            @endif

            <!-- Verifica se a permissão de edição está definida -->
            @if ($usuario->pivot->permissions->edit)
                <!-- Exibir conteúdo permitido para edição -->
                <p>Conteúdo permitido para edição</p>
            @endif

            <!-- Verifica se a permissão de exclusão está definida -->
            @if ($usuario->pivot->permissions->delete)
                <!-- Exibir conteúdo permitido para exclusão -->
                <p>Conteúdo permitido para exclusão</p>
            @endif
        @endif
    @endforeach

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div><a href="{{ route('editor')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Adicionar Texto</a></div>
@endsection
