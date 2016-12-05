<?php

namespace Iba\Http\Controllers;

use Iba\Models\License;

use Iba\Http\Requests;


class LicenseController extends Controller
{
    //
    public function index(){

        $licencas = License::first();
        return view('licencas')->with(compact('licencas'));
    }
}
