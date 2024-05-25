<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\GConfig;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $user = auth()->user();
        $config = GConfig::where('user_id', $user_id)->first();
        return view('user.index', compact('user', 'config'));
    }
}
