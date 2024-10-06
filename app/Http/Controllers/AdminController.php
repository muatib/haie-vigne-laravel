<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Form;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $forms = Form::all();

        return view('dashboard', compact('users', 'forms'));
    }
}
