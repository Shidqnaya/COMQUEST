<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserItem;

class CustomizeController extends Controller
{
    public function userindex()
    {
        $user = Auth::user();
        
        // Retrieve items owned by the user
        $userItems = UserItem::where('user_id', $user->id)->with('item')->get();

        return view('user.customize', ['user'=> $user,'userItems' => $userItems]);
    }

    public function adminindex(){
        $user = Auth::user();

        return view('admin.customize', ['user' => $user]);

    }
}
