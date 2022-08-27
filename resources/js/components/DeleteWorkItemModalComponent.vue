<template>
      <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container-confirm">

          <div class="modal-header">
            <slot name="header">
              Confirm
            </slot>
          </div>  

          <div class="modal-body">
            <slot name="body">
                Delete this work item?
            </slot>
          </div>

          <div class="modal-footer">
            <slot name="footer">
              <form :action="`${this.$attrs.data.postroute}`" method="POST">
                <input type="hidden" name="_token" :value="`${this.$attrs.data.csrftoken}`">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="vehicleid" :value="`${this.$attrs.data.vehicleid}`">

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