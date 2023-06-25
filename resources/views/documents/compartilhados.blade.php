@extends('base')

@section('title', 'Documents Compartilhados')

@section('content')


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
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">{{$item->id}}</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">{{$item->nome}}</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">{{$item->createBy}}</td>
                <td>

                    @foreach ($item->usuarios as $usuario)


                    <?php
                    $usuarioId = $usuario->id;
                    $usuarioNome = $usuario->name;


                    $pivot = $usuario->pivot;
                    $permissoes = json_decode($pivot->permissions, true);
                    ?>


                    @if (array_key_exists('view', $permissoes) && $permissoes['view'])
                    <a href="{{ route('documents.visualizar', $item->id) }}" class="inline-flex items-center rounded-lg border border-yelow-500 bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-grey-700 hover:bg-green-700 focus:ring focus:ring-red-200 disabled:cursor-not-allowed disabled:border-grey-300 disabled:bg-grey-300" target="_blank">BAIXAR</a>

                    <!-- <p>visualização</p> -->
                    @endif

                    @if (array_key_exists('edit', $permissoes) &&  $permissoes['edit'])

                    <!-- <p>edição</p> -->
                <td><a href="{{route('documents.editar', $item['id'])}}" class="inline-flex items-center rounded-lg border border-yelow-500 bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-grey-700 hover:bg-green-700 focus:ring focus:ring-red-200 disabled:cursor-not-allowed disabled:border-grey-300 disabled:bg-grey-300">EDITAR</td>

                    @endif


                    @if (array_key_exists('delete', $permissoes) && $permissoes['delete'])

                    <!-- <p>exclusão</p> -->
                <td><a href="{{route('documents.apagar', $item['id'])}}" class="inline-flex items-center rounded-lg border border-red-500 bg-red-500 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-red-700 hover:bg-red-700 focus:ring focus:ring-red-200 disabled:cursor-not-allowed disabled:border-red-300 disabled:bg-red-300">EXCLUIR</a></td>

                    @endif

                    @endforeach

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
