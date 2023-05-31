<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UploadController extends Controller
{
    public function index() {
        return view('upload.index');
    }

    public function save(Request $form) {
        //dd($form);
        $arquivo = $form->file('file');

        //Grava com nome aleatorio
        $arquivo->store('public');
        dd($arquivo);

        //Grava com nome original
        // $arquivo->storeAs('public', $arquivo->getClientOriginalName());

        return 'Gravado!';
    }
}
