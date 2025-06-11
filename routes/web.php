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

Route::put('/reply/{reply}', function (Reply $reply) {
  $validated = request()->validate([
    'reply' => 'required|max:100'
  ]);

  Gate::authorize('update', $reply);

  return response()->json(['message' => 'Reply deleted successfully']);
});

Route::post('/reply-comment', function () {
  $validated = request()->validate([
    'comment_id' => 'string',
    'post_id' => 'string',
    'reply' => 'required|max:100'
  ]);

  Reply::create([
    'comment_id' => $validated['comment_id'],
    'post_id' => $validated['post_id'],
    'user_id' => Auth::id(),
    'reply' => $validated['reply']
  ]);

  return response()->json(['message' => 'Reply successfully']);
});
