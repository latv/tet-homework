<?php

namespace Tet\Products\Controllers;

use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        // Note the view syntax: 'packageNamespace::viewName'
        return view('products::index');
    }
}