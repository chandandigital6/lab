<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuoteEnqueryController extends Controller
{
    public function create(){
        return view('quoteEnqry.create');
    }
}
