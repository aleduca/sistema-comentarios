<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/post/{post}', function (Post $post) {
  $post->load('comments.replies');
  return view('post.show', compact('post'));
});
