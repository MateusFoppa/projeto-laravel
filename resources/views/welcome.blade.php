@extends('base')

@section('title', 'Index')

@section('content')
    <?php
        return redirect()->route('user.login');
    ?>
@endsection
