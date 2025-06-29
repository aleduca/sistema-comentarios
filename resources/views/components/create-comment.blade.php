@props(['post'])
<form class="mb-6" action={{ route('comment.store',$post->id) }} method="post">
    @csrf
    <div class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        @error('comment') <span class="text-red-500 italic text-sm">{{$message}}</span> @enderror
        <label for="comment" class="sr-only">Your comment</label>
        <textarea id="comment" rows="6" name="comment"
            class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
            placeholder="Write a comment..."></textarea>
    </div>
    <button type="submit"
        class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800 cursor-pointer">
        Post comment
    </button>
</form>