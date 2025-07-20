<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function __construct()
    {
        // Middleware is applied at route level
    }
    
    public function index(): View
    {
        return view('home');
    }

    public function features(): View
    {
        return view('features');
    }

    public function pricing(): View
    {
        return view('pricing');
    }

    public function about(): View
    {
        return view('about');
    }

    public function contact(): View
    {
        return view('contact');
    }
} 