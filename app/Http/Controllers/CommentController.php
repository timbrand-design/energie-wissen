<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
{
    $validated = $request->validate([
        'content' => 'required|string|max:1000',
    ]);

    $article->comments()->create([
        'user_id' => auth()->id(),
        'content' => $validated['content'],
    ]);

    return back()->with('success', 'Kommentar wurde erstellt.');
}
public function destroy(Article $article, Comment $comment)
{
    if ($comment->article_id !== $article->id) {
        abort(404);
    }

    $this->authorize('delete', $comment);

    $comment->delete();

    return back()->with('success', 'Kommentar wurde gelöscht.');
}
}
