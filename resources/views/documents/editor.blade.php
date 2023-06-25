@extends('base')

@section('title', 'Editar Documento')

@section('content')

<!-- include libraries(jQuery, bootstrap) -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<h2>Editar</h2>

@if ($errors->any())
<div class="bg-red-50 text-red-500 p-4">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
@if(isset($documents))
<form method="post" action="{{ route('documents.editar', $documents->id) }}" enctype="multipart/form-data">

@method('put')
    @csrf

    <input type="hidden" name="id" value="{{ $documents->id }}">

    <label for="nomedata">Nome do Documento</label>
    <input type="text" name="nomedata" value="{{ $documents->nome }}" class="border border-gray-300 rounded-md p-2 mb-10">
    <div>
        <textarea type="text" id="summernote" name="editordata">{{ $documents->texto }}</textarea>
    </div>
    <script>
      $(document).ready(function() {
        $('#summernote').summernote();
      });
    </script>

    <input type="submit" value="Gravar" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
</form>
@endif
@endsection
