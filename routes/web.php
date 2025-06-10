<?php

use App\Models\Comment;
use App\Models\Post;
use App\Models\Reply;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  Auth::loginUsingId(1);
})->name('home');


Route::get('/post/{post}', function (Post $post) {
  $post->load('comments.replies');
  return view('post.show', compact('post'));
})->middleware('auth');

Route::post('/comment/{postId}', function ($postId) {
  $validated = request()->validate([
    'comment' => 'required|max:100'
  ]);

  Comment::create([
    'post_id' => $postId,
    'user_id' => Auth::id(),
    'comment' => $validated['comment']
  ]);

  return back()->with('success', 'Comment created successfully');
})->name('comment.store');

Route::delete('/comment/{comment}', function (Comment $comment) {
  Gate::authorize('delete', $comment);

  // $comment->delete();

  return response()->json(['message' => 'Comment deleted successfully']);
});

Route::delete('/reply/{comment}', function (Reply $comment) {
  Gate::authorize('delete', $comment);

  return response()->json(['message' => 'Reply deleted successfully']);
});

Route::put('/comment/{comment}', function (Comment $comment) {

  $validated = request()->validate([
    'comment' => 'required|max:100'
  ]);

  Gate::authorize('update', $comment);

  $comment->comment = $validated['comment'];
  $comment->save();

  return response()->json(['message' => 'Comment updated successfully']);
});

Route::put('/reply/{reply}', function (Reply $comment) {
  $validated = request()->validate([
    'reply' => 'required|max:100'
  ]);

  Gate::authorize('update', $comment);

  return response()->json(['message' => 'Reply deleted successfully']);
});
