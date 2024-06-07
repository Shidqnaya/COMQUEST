<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    public function userindex()
    {
    // Ambil pengguna saat ini
    $user = Auth::user();
    
    // Ambil semua pengguna dan urutkan berdasarkan skor tertinggi
    $users = User::orderBy('score', 'desc')->get();
    
    // Kirim data pengguna saat ini dan semua pengguna ke view
    return view('user.leaderboard', ['user' => $user, 'users' => $users]);
    }

    public function adminindex()
    {
    // Ambil pengguna saat ini
    $user = Auth::user();
    
    // Ambil semua pengguna dan urutkan berdasarkan skor tertinggi
    $users = User::orderBy('score', 'desc')->get();
    
    // Kirim data pengguna saat ini dan semua pengguna ke view
    return view('admin.leaderboard', ['user' => $user, 'users' => $users]);
    }


}
