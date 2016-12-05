<?php

namespace Iba\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Iba\Http\Requests;
use Iba\Http\Controllers\Controller;

class TabelasDeApoioController extends Controller
{
    public function index(){

        return view('admin.tabelas-de-apoio.index');
    }
}
