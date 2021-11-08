<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function index()
    {
        //return MainController::class; //App\Http\Controllers\Test\MainController
        return view('welcome');
    }

    public function testPost()
    {
        return response()->json(['first_test' => 'ok'], 201);
    }

    public function testPut()
    {
        return response()->json(['put' => 'ok']);
    }

    public function testAny()
    {
        return response()->json(['any_method' => 'ok']);
    }

    public function html()
    {
        return response('current string', 404);
    }
}