<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('auth', only: ['create']),
        ];
    }
    public function create()
    {
        return view('article.create');
    }

    public function index()
    {
        $articles = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->paginate(10);
        return view('article.index', compact('articles'));
    }

    public function show(Article $article)
    {
        return view('article.show', compact('article'));
    }

    public function byCategory(Category $category)
    {
        $articles = $category->articles->where('is_accepted', true);
        return view('article.byCategory', compact('articles', 'category'));
    }

    public function destroy(Article $article)
    {
        // 2. Pulizia file fisici e database
        if ($article->images->isNotEmpty()) {
            foreach ($article->images as $image) {
                // Cancella il file dallo storage
                Storage::delete($image->path);

                // Opzionale: se l'immagine appartiene SOLO a questo articolo, eliminala del tutto
                // $image->delete(); 
            }

            // Rimuove i legami nella tabella pivot
            $article->images()->delete();
        }

        // 3. Eliminazione articolo
        $article->delete();

        // 4. Redirect con feedback
        return redirect()->route('article.index')
            ->with('message', "L'articolo \"{$article->title}\" è stato eliminato con successo.");
    }
}
