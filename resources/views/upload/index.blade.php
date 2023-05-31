@extends('base')

@section('title', 'Upload')

@section('content')

    <form action="{{ route('upload.save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file">
        <br>
        <input type="submit" value="Gravar">
    </form>

@endsection