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
              {{ message }}
            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              <form action="#" method="POST">
                <input type="hidden" name="_token" value="csrf">
                <input type="hidden" name="_method" value="DELETE">

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
        props: {
            message: String,
        },
        data() {
            return {
                // message: ''
            }
            
        }
     }
</script>