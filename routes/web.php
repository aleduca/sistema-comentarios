<?php

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
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
