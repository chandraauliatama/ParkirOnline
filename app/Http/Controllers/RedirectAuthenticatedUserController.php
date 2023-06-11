<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectAuthenticatedUserController extends Controller
{
    public function home()
    {
        switch (auth()->user()->role) {
            case 'admin':
                return redirect('/admin');
            default:
                return redirect('/');
        }

        return auth()->logout();
    }
}
