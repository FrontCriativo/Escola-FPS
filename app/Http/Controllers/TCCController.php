<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TCCController extends Controller
{
    public function index()
    {
        return view('tcc.index');
    }

    public function todos()
    {
        return view('tcc.todos');
    }
}
