<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScannerController extends Controller
{
    //

    function index(string $id_zona=null){

        return view("scaner.index");
    }


}
