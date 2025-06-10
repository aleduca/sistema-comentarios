
@props(['reply'])
<div x-cloak x-show="canEdit">
 <textarea id="comment" rows="6" name="comment" x-ref="comment"
        class="p-2 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800 rounded"
        placeholder="Write a comment...">
  </textarea>
  <button class="bg-amber-400 p-2 rounded text-xs cursor-pointer" @click="canEdit=false;errorValidateEdit=''">Back to comment</button>
  <button class="bg-green-400 p-2 rounded text-xs cursor-pointer" @click="updateComment({{ $reply->id }})">Update</button>
</div>