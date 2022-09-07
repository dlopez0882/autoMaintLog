<template>
    <div class="modal-mask">
      <div class="modal-wrapper">
          <div class="modal-container modal-container-form">
              <div class="card">
                  <div class="card-header">
                      <slot name="header">
                          Add a new {{ headerString }}
                      </slot>
                  </div>  

                  <div class="card-body">
                      <slot name="body">
                          <form action="#" method="POST">
                              <div v-for="(type, field) in fields" class="mb-3">
                                  <label :for="field">{{ field }}</label>
                                  <input
                                      :type="type" 
                                      :name="field" 
                                      :id="field"
                                      class="form-control" 
                                      value=""
                                  >
                                  <!-- <div class="text-danger" v-if="v$.year.$error">Year field is required and must be between {{ yearMin }} and {{ yearMax }}.</div>  -->
                              </div>
                              <div class="text-end">
                                  <slot name="footer">
                                      <button type="button" class="btn btn-light me-2" @click="$emit('close')">
                                          Cancel
                                      </button>
                                      
                                      <button type="submit" class="btn btn-primary" @click="$emit('close')">
                                          OK
                                      </button>
                                  </slot>
                              </div>
                          </form>
                      </slot>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
  export default {
      props: {
          headerString: String,
          fields: Object,
      },
      data() {
          return {
              // headerString: ''
          }
          
      }
   }
</script>