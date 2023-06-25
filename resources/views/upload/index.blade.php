@extends('base')

@section('title', 'Upload')

@section('content')

    <form action="{{ route('upload.save') }}" method="POST" enctype="multipart/form-data" class="max-w-sm mx-auto my-8">
        @csrf
        <div class="mb-4">
            <label for="file" class="block text-gray-700 font-bold mb-2">Selecione o arquivo:</label>
            <input type="file" name="file" id="file" class="border bg-gray-100 border-gray-300 py-8 px-6 rounded-md shadow-sm focus:outline-none focus:ring focus:border-blue-500">
        </div>
        <div class="text-center">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Gravar</button>
        </div>
    </form>

@endsection
