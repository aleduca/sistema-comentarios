@extends('layout')

@section('content')

<section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
  <div class="max-w-2xl mx-auto px-4">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Comments ({{ $post->comments->count() }})</h2>
    </div>
    <form class="mb-6">
        <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <label for="comment" class="sr-only">Your comment</label>
            <textarea id="comment" rows="6"
                class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                placeholder="Write a comment..." required></textarea>
        </div>
        <button type="submit"
            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800 cursor-pointer">
            Post comment
        </button>
    </form>
    @forelse($post->comments as $comment)
    <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900" x-data="comments">
        <footer class="flex justify-between items-center mb-2 relative">
            <div class="flex items-center">
                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold"><img
                        class="mr-2 w-6 h-6 rounded-full"
                        src="{{ $comment->user->photo }}"
                        alt="Michael Gough">{{$comment->user->fullName}}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-08"
                        title="{{ $comment->created_at->translatedFormat('d/F/Y H:i:s') }}">{{ $comment->created_at->translatedFormat('d/F/Y H:i:s') }}</time></p>
            </div>
            <button id="dropdownComment1Button"
            @click="openDropdown = !openDropdown"
            data-dropdown-toggle="dropdownComment1"
                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-400 bg-white rounded-lg hover:bg-gray-100  dark:bg-gray-900 dark:hover:bg-gray-700 outline-none cursor-pointer"
                type="button">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
                    <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
                </svg>
                <span class="sr-only">Comment settings</span>
            </button>
            <!-- Dropdown menu -->
            <x-dropdown-comments />
        </footer>
        <p class="text-gray-500 dark:text-gray-400">{{ $comment->comment }}</p>
    </article>
    @foreach($comment->replies as $reply)
    <article class="p-6 mb-3 ml-6 lg:ml-12 text-base bg-white rounded-lg dark:bg-gray-900" x-data="comments">
        <footer class="flex justify-between items-center mb-2 relative">
            <div class="flex items-center">
                <p class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold"><img
                        class="mr-2 w-6 h-6 rounded-full"
                        src="{{ $reply->user->photo }}"
                        alt="Jese Leos">{{ $reply->user->fullName }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400"><time pubdate datetime="2022-02-12"
                        title="{{ $reply->created_at->translatedFormat('d/F/Y H:i:s') }}">{{ $reply->created_at->translatedFormat('d/F/Y H:i:s') }}</time></p>
            </div>
            <button id="dropdownComment2Button" data-dropdown-toggle="dropdownComment2"
            @click="openDropdown = !openDropdown"
            class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-500 dark:text-gray-40 bg-white rounded-lg hover:bg-gray-100 outline-none cursor-pointer  dark:bg-gray-900 dark:hover:bg-gray-700"
            type="button">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 3">
              <path d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z"/>
            </svg>
            <span class="sr-only">Comment settings</span>
          </button>
            <!-- Dropdown menu -->
            <x-dropdown-comments />
        </footer>
        <p class="text-gray-500 dark:text-gray-400">{{ $reply->reply }}</p>
    </article>
    @endforeach
    @empty
      <h2 class="text-3xl bold text-white">No comments, Be the first !</h2>
    @endforelse

  </div>
</section>


@endsection