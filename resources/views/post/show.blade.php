@extends('layout')

@section('content')

<section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
  <div class="max-w-2xl mx-auto px-4">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Comments ({{ $post->comments->count() }})</h2>
    </div>
    @if(session('success'))
      <div class="text-green-600 italic text-sm">{{ session('success') }}</div>
    @endif
    <x-create-comment :post="$post" />
    @forelse($post->comments as $comment)
    <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900" id="comment-{{ $comment->id }}" x-data="comments('comment')">
      <template x-if="loading">
        <div class="text-white text-sm italic">Aguarde...</div>
      </template>
      <x-comment :comment="$comment" />
      <x-comment-edit :comment="$comment" />
    </article>
    @foreach($comment->replies as $reply)
    <article class="p-6 mb-3 ml-6 lg:ml-12 text-base bg-white rounded-lg dark:bg-gray-900" id="reply-{{ $reply->id }}" data-parent-id="{{ $comment->id }}" x-data="comments('reply')">
        <template x-if="loading">
          <div class="text-white text-sm italic">Aguarde...</div>
        </template>
        <x-reply :reply="$reply" />
        <x-reply-edit :reply="$reply" />
    </article>
    @endforeach
    @empty
      <h2 class="text-3xl bold text-white">No comments, Be the first !</h2>
    @endforelse

  </div>
</section>


@endsection