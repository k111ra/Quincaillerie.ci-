<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
  public function index()
  {
    return view('contact');
  }

  public function store(Request $request)
  {
    // Validation du formulaire
    $request->validate([
      'name' => 'required|string|max:255',
      'phone' => 'required|string|max:255',
      'email' => 'required|email|max:255',
      'location' => 'nullable|string|max:255',
      'message' => 'required|string',
    ]);

    // Enregistrement dans la base de données
    $message = Message::create([
      'name' => $request->input('name'),
      'phone' => $request->input('phone'),
      'email' => $request->input('email'),
      'location' => $request->input('location'), // Correction ici
      'message' => $request->input('message'),
    ]);

    // Envoi de l'email de notification
    Mail::to('admin@quincaillerie.ci')->send(new ContactMessage($message));

    return back()->with('success', 'Merci pour votre message. Nous vous contacterons bientôt.');
  }
}
