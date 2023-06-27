@extends('base')

@section('title', 'Documents Compartilhados')

@section('content')


<div class="mb-5">
    <table class="w-full bg-white">
        <thead>
            <tr>
                <th class="px-6 py-3 text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider">Documento</th>
                <th class="px-6 py-3 text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider">Usuário</th>
                <th class="px-6 py-3 text-xs leading-4 font-medium text-gray-700 uppercase tracking-wider">Ações</th>
            </tr>
        </thead>

        <tbody class=" bg-white divide-gray-200">
            @foreach ($documentos as $item)
            @foreach ($item->usuarios as $usuario)
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">{{$item->id}}</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">{{$item->nome}}</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">{{$usuario->name}}</td>
                <td>



                    <?php
                    $usuarioId = $usuario->id;
                    $usuarioNome = $usuario->name;


                    $pivot = $usuario->pivot;
                    $permissoes = json_decode($pivot->permissions, true);
                    ?>


                    @if (array_key_exists('view', $permissoes) && $permissoes['view'])
                    <a href="{{ route('documents.visualizar', $item->id) }}" class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">BAIXAR</a>

                    <!-- <p>visualização</p> -->
                    @endif

                    @if (array_key_exists('edit', $permissoes) && $permissoes['edit'])

                    <!-- <p>edição</p> -->
                <td><a href="{{route('documents.editar', $item['id'])}}" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">EDITAR</td>

                @endif


                @if (array_key_exists('delete', $permissoes) && $permissoes['delete'])

                <!-- <p>exclusão</p> -->
                <td><a href="{{route('documents.apagar', $item['id'])}}" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">EXCLUIR</a></td>

                @endif

                @endforeach

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
