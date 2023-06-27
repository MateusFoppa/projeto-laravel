{{-- resources/views/documents/index.blade.php --}}
@extends('base')

@section('title', 'Documents')

@section('content')

<!-- Listar os produtos em estoque -->
<div class="mb-5">
    <table class="min-w-full divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Produto</th>
                <th class="px-6 py-3 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Usuário</th>
            </tr>
        </thead>

        <tbody class=" bg-white divide-gray-200">
            @foreach ($lista as $item)
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">{{$item['id']}}</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">{{$item['nome']}}</a></td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">{{$item->createdByUser->name}}</td>

                <td><a href="{{route('documents.apagar', $item['id'])}}" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900">EXCLUIR</a></td>
                <td><a href="{{ route('usuarios.listar', $item['id']) }}" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">COMPARTILHAR</td>
                <td><a href="{{route('documents.editar', $item['id'])}}" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">EDITAR</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
