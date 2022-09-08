<template>
    <div class="modal-mask">
      <div class="modal-wrapper">
          <div class="modal-container modal-container-form">
              <div class="card">
                  <div class="card-header">
                      <slot name="header">
                          Add a new {{ table }}
                      </slot>
                  </div>  

                  <div class="card-body">
                      <slot name="body">
                          <form action="submitForm" method="POST">
                              <div v-for="field in fields" :key="field.name" class="mb-3">
                                  <label :for="field.name">{{ field.name }}</label>
                                  <input
                                      :type="field.type" 
                                      :name="field.name" 
                                      :id="field.name"
                                      class="form-control" 
                                      v-model="field.value"
                                  >
                                  <!-- <div class="text-danger" v-if="v$.year.$error">Year field is required and must be between {{ yearMin }} and {{ yearMax }}.</div>  -->
                              </div>
                              <div class="text-end">
                                  <slot name="footer">
                                      <button type="button" class="btn btn-light me-2" @click="$emit('close')">
                                          Cancel
                                      </button>
                                      
                                      <button type="submit" class="btn btn-primary" @click.prevent="submitForm">
                                          Submit
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
        table: String,
        fields: Object,
        postroute: String,
      },
      data() {
          return {
            // TODO: figure out how to get field values to data properly
          }
          
      },
      methods: {
            async submitForm () {
                // const isFormCorrect = await this.v$.$validate()

                // if validation returns errors, do nothing
                // if (!isFormCorrect) return

                // otherwise, submit form
                // gather data from form
                const vehicleProps = {
                    year: this.$refs.year.value, 
                    make: this.$refs.make.value, 
                    model: this.$refs.model.value
                }

                // json the data from form
                const data = JSON.stringify({vehicleProps})
                console.log(data)
                const config = {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }

                // submit data to laravel
                axios.post(this.postroute, data, config)
                    // .then(response => console.log(response))
                    .then(response => {
                        // console.log(response)
                        window.location.href = '/';
                    })
                    .catch(error => console.log(error));
            }
        }
   }
</script>