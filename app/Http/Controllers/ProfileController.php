<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Exibe a página de perfil do usuário autenticado.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        // This method returns the 'users/profile' view.
        return view('users.profile');
    }
}
