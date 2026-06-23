<?php

namespace App\Http\Controllers;

use App\Mail\BecomeRevisor;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RevisorController extends Controller
{
  public function index()
  {
    $article_to_check = Article::where('is_accepted', null)
      ->orderBy('created_at', 'asc')
      ->first();

    $last_reviewed_article = Article::whereNotNull('is_accepted')
      ->orderBy('updated_at', 'desc')
      ->first();

    return view('revisor.index', compact('article_to_check', 'last_reviewed_article'));
  }

  public function accept(Article $article)
  {
    $article->setAccepted(true);
    return redirect()
      ->back()
      ->with('message', "Hai accettato l'articolo $article->title");
  }

  public function reject(Article $article)
  {
    $article->setAccepted(false);
    return redirect()
      ->back()
      ->with('message', "Hai rifiutato l'articolo $article->title");
  }

  //funzione per ripristino dell'articolo rifiutato o accettato
  public function restore(Article $article)
  {
    $article->setAccepted(null);
    return redirect()
      ->back()
      ->with('message', "Hai ripristinato l'articolo $article->title");
  }
  public function becomeRevisor(Request $request)
  {
    $request->validate([
      'motivation' => 'required|min:10',
    ]);
    Mail::to('admin@presto.it')->send(new BecomeRevisor(Auth::user(), $request->motivation));
    return redirect()->route('home')->with('message', 'La tua richiesta è stata inviata con successo');
  }
  public function makeRevisor(User $user)
  {
    Artisan::call('app:make-user-revisor', ['email' => $user->email]);
    return redirect()->back();
  }

  public function workWithUs()
  {
    return view('revisor.work-with-us');
  }
}
