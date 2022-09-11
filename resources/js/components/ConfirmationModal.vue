<template>
    <div class="modal-mask">
    <div class="modal-wrapper">
      <div class="modal-container modal-container-confirm">

        <div class="modal-header">
          <slot name="header">
            Confirmation modal
          </slot>
        </div>  

        <div class="modal-body">
          <slot name="body">
              Are you sure that you want to delete this {{ table.slice(0,-1) }}?
          </slot>
        </div>

        <div class="modal-footer">
          <slot name="footer">
            <form :action="postroute" method="POST">
              <input type="hidden" name="_token" :value="csrfToken">
              <input type="hidden" name="_method" :value="method">

              <button type="button" class="btn btn-light me-2" @click="$emit('close')">
                Cancel
              </button>
            
              <button type="submit" class="btn btn-danger" @click="$emit('close')">
                OK
              </button>
            </form>
          </slot>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
      data() {
          return {
            csrfToken: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
      },
      props: {
          table: String,
          method: String,
          postroute: String,
      }
   }
</script>