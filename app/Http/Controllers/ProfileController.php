<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('profile');
    }
}
