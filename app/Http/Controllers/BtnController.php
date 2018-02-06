<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BtnController extends Controller
{

    public static function delete($id, $url='', $class='', $size=true, $name=null, $message='Delete action is not reversible!', $tooltip='Delete')
    {
        # code...
        return view('layouts.delete', compact('id', 'url', 'class', 'size', 'name', 'message', 'tooltip'))->render();
    }

    public static function ajax_delete($id, $url='',$class='', $size=true, $name=null, $message='Delete action is not reversible!')
    {
        # code...
        return view('layouts.delete', compact('id', 'url','class', 'size', 'name', 'message'))->render();
    }
}
