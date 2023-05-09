{{-- resources/views/estoque/apagar.blade.php --}}
@extends('base')
@section('title', 'Estoque')

@section('content')
<div> 🤔 Tem certeza que deseja apagar</div>

<p>Você está prestes a apagar {{$estoque['nome']}}.</p>

<form action="{{route('estoque.apagar', $estoque['id'])}}
"method="post">
    @method('delete')
    @csrf

    <button type='submit'>Apaga logo isso aí 👌</button>

</form>
@endsection