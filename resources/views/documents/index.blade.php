{{-- resources/views/documents/index.blade.php --}}
@extends('base')

@section('title', 'Documents')

@section('content')

<!-- Listar os produtos em estoque -->
<div class="mb-5">
    <table class="min-w-full divide-gray-200">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">ID</th>
                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Produto</th>
                <th class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Usuário</th>
            </tr>
        </thead>

        <tbody class=" bg-white divide-gray-200">
            @foreach ($lista as $item)
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">{{$item['id']}}</td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">{{$item['nome']}}</a></td>
                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">{{$item['createBy']}}</td>

                <td><a href="{{route('documents.apagar', $item['id'])}}" class="inline-flex items-center rounded-lg border border-red-500 bg-red-500 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-red-700 hover:bg-red-700 focus:ring focus:ring-red-200 disabled:cursor-not-allowed disabled:border-red-300 disabled:bg-red-300">EXCLUIR</a></td>
                <td><a href="{{ route('usuarios.listar', $item['id']) }}" class="inline-flex items-center rounded-lg border border-yelow-500 bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-grey-700 hover:bg-green-700 focus:ring focus:ring-red-200 disabled:cursor-not-allowed disabled:border-grey-300 disabled:bg-grey-300">COMPARTILHAR</td>
                <td><a href="{{route('documents.editar', $item['id'])}}" class="inline-flex items-center rounded-lg border border-yelow-500 bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white shadow-sm transition-all hover:border-grey-700 hover:bg-green-700 focus:ring focus:ring-red-200 disabled:cursor-not-allowed disabled:border-grey-300 disabled:bg-grey-300">EDITAR</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div><a href="{{ route('editor')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Adicionar Texto</a>
<a href="{{ route('upload')}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Upload de Documentos</a>

</div>

@endsection
