<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $currentUser = auth()->user();
        
        if ($currentUser->isAdmin()) {
            $totalUsers = User::count();
            $adminUsers = User::where('role', 'admin')->count();
            $organizerUsers = User::where('role', 'organizer')->count();
            $companyUsers = User::where('role', 'company')->count();
            $coachUsers = User::where('role', 'coach')->count();
            $playerUsers = User::where('role', 'player')->count();
            $recentUsers = User::latest()->take(5)->get();
        } else {
            // Per gli organizzatori, mostra solo i loro utenti
            $totalUsers = User::where('organizer_id', $currentUser->id)->count();
            $companyUsers = User::where('organizer_id', $currentUser->id)->where('role', 'company')->count();
            $coachUsers = User::where('organizer_id', $currentUser->id)->where('role', 'coach')->count();
            $playerUsers = User::where('organizer_id', $currentUser->id)->where('role', 'player')->count();
            $recentUsers = User::where('organizer_id', $currentUser->id)->latest()->take(5)->get();
            
            // Per gli organizzatori, questi valori sono 0
            $adminUsers = 0;
            $organizerUsers = 0;
        }

        return view('admin.dashboard', compact('totalUsers', 'adminUsers', 'organizerUsers', 'companyUsers', 'coachUsers', 'playerUsers', 'recentUsers'));
    }

    public function users()
    {
        return view('admin.users');
    }



    public function settings()
    {
        return view('admin.settings');
    }
} 