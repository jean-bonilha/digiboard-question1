<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

class RecognizeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('app');
    }

    public function model($model)
    {
        return File::get(public_path('models/' . $model));
    }

    public function weight($weight)
    {
        return File::get(public_path('weights/' . $weight));
    }
}
