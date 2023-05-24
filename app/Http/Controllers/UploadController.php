<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class UploadController extends Controller
{
    public function index() {
        return view('upload.index');
    }

    public function save(Request $form) {
        
        $arquivo = $form->file('txt');

        //Grava com nome aleatorio
        $arquivo->store('public');

        //Grava com nome original
        // $arquivo->storeAs('public', $arquivo->getClientOriginalName());

        return 'Gravado!';
    }
}
