<?php

namespace App\Http\Controllers;

use App\Models\Items;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    public function section1 () {

        $items = Items::getItemsPaginanted();

        $data = [
            'items' => $items,
        ];

        return view('screen1', compact('data'));       
    }

    public function section2 () {
        return view('screen2');
    }

    public function section3 () {
        return view('screen3');
    }
}
