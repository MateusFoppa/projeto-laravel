@extends('base')

@section('title', 'Lista de Usuários')

@section('content')

<form action="{{ route('documents.compartilhar', $documento) }}" method="POST">
    @csrf
    <div class="bg-gray-200">
        <table class="w-full bg-gray-200">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nome</th>
                    <th class="px-4 py-2 text-center">Compartilhar</th>
                    <th class="px-4 py-2 text-center">Permissão de Edição</th>
                    <th class="px-4 py-2 text-center">Permissão de Visualização</th>
                    <th class="px-4 py-2 text-center">Permissão de Exclusão</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usuarios as $usuario)
                <tr>
                    <td class="border px-4 py-2 text-center">{{ $usuario->name }}</td>
                    <td class="border px-4 py-2 text-center">
                        <input type="checkbox" name="usuarios[]" value="{{ $usuario->id }}" class="form-checkbox">
                    </td>
                    <td class="border px-4 py-2 text-center">
                        <input type="checkbox" name="permissions[{{ $usuario->id }}][]" value="edit" class="form-checkbox">
                    </td>
                    <td class="border px-4 py-2 text-center">
                        <input type="checkbox" name="permissions[{{ $usuario->id }}][]" value="view" class="form-checkbox">
                    </td>
                    <td class="border px-4 py-2 text-center">
                        <input type="checkbox" name="permissions[{{ $usuario->id }}][]" value="delete" class="form-checkbox">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4 flex justify-center">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Compartilhar
        </button>
    </div>
</form>
@endsection
