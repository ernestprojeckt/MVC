<?php

namespace App\Controllers;

use Core\Controller;

class HomeController extends Controller
{
    public function index(int $id)
    {
        d($id);
    }

    public function test(){
        dd('test passed');
    }
}