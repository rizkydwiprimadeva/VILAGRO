<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function scanner()
    {
        return view('pages.scanner');
    }

    public function encyclopedia()
    {
        return view('pages.encyclopedia');
    }

    public function guide()
    {
        return view('pages.guide');
    }

    public function consultation()
    {
        return view('pages.consultation');
    }
}