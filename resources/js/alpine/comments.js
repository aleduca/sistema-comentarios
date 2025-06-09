export default (type = 'comment') => {
  return {
    openDropdown: false,
    async removeComment(commentId){
      try{
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

        const data = await response.json();
        alert(data.message);
      }catch(error){
        if(error?.message){
          alert(error.message)
        }
        console.log(error);
      } finally{
        this.openDropdown = false;
      }
    }
  }
}