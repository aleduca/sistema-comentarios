<div @open-modal-reply.window="eventReceived($event)" x-data="{
  openModal:false,
  comment:{
    from:'',
    commentId:'',
    postId:''
  },
  error:'',
  loading:false,
  reply:'',
  eventReceived(event){
    this.openModal = true;
    this.comment = event.detail;
    setTimeout(() => {
      this.$refs.comment.focus();
    }, 200)
    console.log(this.comment);
  },
  async replyComment(){
    try{
      this.loading = true;

      const response = await fetch('/reply-comment',{
        method:'POST',
        headers:{
            'X-CSRF-TOKEN': document.querySelector('#csrf-token').content,
            'Accept':'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          comment_id: this.comment.commentId,
          post_id: this.comment.commentId,
          reply: this.reply
        })
      });

      if(!response.ok){
        const data = await response.json();
        throw new Error(data.message || 'Something went wrong');
      }

      this.openModal = false;
      this.error = '';
      window.location.reload();
    }catch(error){
      if(error?.message){
        this.error = error.message;
      }
    }finally{
      this.loading = false;
    }
  }
}" x-cloak>
  <button class="rounded-md bg-gray-950/5 px-2.5 py-1.5 text-sm font-semibold text-gray-900 hover:bg-gray-950/10">Open dialog</button>

  <div class="relative z-10" aria-labelledby="dialog-title" role="dialog" aria-modal="true" x-show="openModal">
    <!--
      Background backdrop, show/hide based on dialog state.

      Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity" aria-hidden="true"
    x-show="openModal"
    x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
    ></div>

    <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
      <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <!--
          Dialog panel, show/hide based on dialog state.

          Entering: "ease-out duration-300"
            From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            To: "opacity-100 translate-y-0 sm:scale-100"
          Leaving: "ease-in duration-200"
            From: "opacity-100 translate-y-0 sm:scale-100"
            To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        -->
        <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg"
        @click.outside="openModal = false"
        x-show="openModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
          <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-red-100 sm:mx-0 sm:size-10">

                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-600">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
              </svg>

              </div>
              <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left flex-1">
                <h3 class="text-base font-semibold text-gray-900" id="dialog-title" x-text="`Responder para ${comment.from}`"></h3>
                <template x-if="error">
                  <div x-text="error" class="text-red-500 text-xs italic"></div>
                </template>
                <template x-if="loading">
                  <div class="text-green-600 italic text-sm">Aguarde, resposta sendo enviada...</div>
                </template>
                <div class="mt-2">
                   <textarea id="comment" rows="6" name="comment" x-model="reply" x-ref="comment"
                      class="p-2 w-full text-sm border border-gray-700 text-gray-900 focus:ring-0 focus:outline-none rounded"
                      placeholder="Write a comment...">
                </textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
            <button type="button" class="inline-flex w-full justify-center rounded-md bg-green-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-green-500 sm:ml-3 sm:w-auto cursor-pointer" @click="replyComment">Reply</button>
            <button type="button" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs ring-1 ring-gray-300 ring-inset hover:bg-gray-50 sm:mt-0 sm:w-auto cursor-pointer" @click=>Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
