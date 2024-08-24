<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Vous pouvez ajouter ici la logique spécifique au tableau de bord de l'administrateur
        return view('admin.dashboard'); // Assurez-vous que 'admin.dashboard' correspond au nom de la vue du tableau de bord de l'administrateur
    }
}
