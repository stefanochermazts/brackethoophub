<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $adminUsers = User::where('role', 'admin')->count();
        $organizerUsers = User::where('role', 'organizer')->count();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalUsers', 'adminUsers', 'organizerUsers', 'recentUsers'));
    }

    public function users()
    {
        return view('admin.users');
    }

    public function tournaments()
    {
        return view('admin.tournaments');
    }

    public function settings()
    {
        return view('admin.settings');
    }
} 