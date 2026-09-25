<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $articles = Article::with(['category', 'user'])
        ->where('is_published', true)
        ->latest()
        ->get();

    return view('articles.index', [
        'articles' => $articles
    ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    $categories = Category::all();
    $users = User::all();

    return view('articles.create', [
        'categories' => $categories,
        'users' => $users,
    ]);
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'excerpt' => 'nullable|string',
        'content' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'user_id' => 'required|exists:users,id',
        'is_published' => 'nullable|boolean',
    ]);

    $validated['slug'] = Str::slug($validated['title']);
    $validated['is_published'] = $request->boolean('is_published');

    Article::create($validated);

    return redirect()
        ->route('articles.index')
        ->with('success', 'Artikel wurde erstellt.');
}

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
{
    $article->load(['category', 'user', 'comments.user']);

    return view('articles.show', [
        'article' => $article
    ]);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
{
    $categories = Category::all();
    $users = User::all();

    return view('articles.edit', [
        'article' => $article,
        'categories' => $categories,
        'users' => $users,
    ]);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'excerpt' => 'nullable|string',
        'content' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'user_id' => 'required|exists:users,id',
        'is_published' => 'nullable|boolean',
    ]);

    $validated['slug'] = Str::slug($validated['title']);
    $validated['is_published'] = $request->boolean('is_published');

    $article->update($validated);

    return redirect()
        ->route('articles.show', $article)
        ->with('success', 'Artikel wurde aktualisiert.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
