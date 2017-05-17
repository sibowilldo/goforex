<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BtnController extends Controller
{
    //
    public static function delete($id, $name=null, $message='Delete action is no reversible!') 
    {
        # code...
        return view('layouts.delete', compact('id', 'name', 'message'))->render();
    }
}
