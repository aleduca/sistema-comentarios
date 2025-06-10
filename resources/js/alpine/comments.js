export default (type = 'comment') => {
  return {
    openDropdown: false,
    loading: false,
    canEdit:false,
    errorValidateEdit:'',
    async removeComment(commentId){
      try{
        this.loading = true;
        const response = await fetch(`/${type}/${commentId}`,{
          method:'DELETE',
          headers:{
            'X-CSRF-TOKEN': document.querySelector('#csrf-token').content,
            'Accept':'application/json'
          }
        });

        if(!response.ok){
          const data = await response.json();
          throw new Error(data?.message || 'Something went wrong');
        }

        document.querySelector(`#${type}-${commentId}`).remove();
        document.querySelectorAll(`[data-parent-id="${commentId}"]`).forEach(reply => reply.remove());

        const data = await response.json();
        alert(data.message);
      }catch(error){
        if(error?.message){
          alert(error.message)
        }
        console.log(error);
      } finally{
        this.openDropdown = false;
        this.loading = false;
      }
    },
    editComment(){
      this.openDropdown = false;
      this.canEdit = true;
      this.$refs.comment.value = this.$refs.originalComment.innerHTML;
      console.log(this.$refs);
    },
    async updateComment(commentId){
      try{
        const response = await fetch(`/${type}/${commentId}`,{
          method:'PUT',
          headers:{
            'X-CSRF-TOKEN': document.querySelector('#csrf-token').content,
            'Accept':'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            [type]: this.$refs.comment.value
          })
        });

        if(!response.ok){
          const data = await response.json();
          throw new Error(data.message || 'Something went wrong');
        }

        this.canEdit = false;
        this.errorValidateEdit = '';
        this.$refs.originalComment.innerHTML = this.$refs.comment.value;

        console.log(response);
      }catch(error){
        if(error?.message){
          this.errorValidateEdit = error.message;
        }
        console.log(error);
      }
    }
  }
}