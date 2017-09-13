<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;

/**
 * @SWG\Info(title="Andrae API", version="0.1.0")
 */

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
