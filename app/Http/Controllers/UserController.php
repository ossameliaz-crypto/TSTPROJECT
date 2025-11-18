<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User; 

class UserController extends Controller
{
    // TUGAS BENING: Get All Users (CRUD Read - RBAC)
    public function index()
    {
        $users = User::all(); 

        return response()->json($users, 200); 
    }
}
