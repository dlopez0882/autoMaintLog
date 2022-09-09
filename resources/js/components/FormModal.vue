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
                                      v-model="state[field.name]"
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
    import { computed } from '@vue/reactivity';
import useVuelidate from '@vuelidate/core';
    import { between, required } from '@vuelidate/validators';
    import axios from 'axios';
    import { reactive } from 'vue';

  export default {
      props: {
        table: String,
        fields: Object,
        postroute: String,
        action: String,
      },
      setup(props) {
        console.log(props.action);
            const state = reactive({
                // year: '',
                // make: '',
                // model: ''
            })
            const yearMin = 1900;
            const yearMax = new Date().getFullYear() + 1;
            const rules = computed(() => {
                if(props.action == 'addvehicle') {
                    return {
                        year: { 
                            between: between(yearMin, yearMax),
                            required 
                        },
                        make: { required },
                        model: { required }
                    }
                } else {
                    return {
                        year: { 
                            between: between(yearMin, yearMax),
                            required 
                        }
                    }
                }
            })
            
            const v$ = useVuelidate(rules, state)

            return { state, /*requiredNameLength,*/ v$ }
      },
      data() {
          return {
            // TODO: figure out how to get field values to data properly
          }
          
      },
        methods: {
            async submitForm () {
                const isFormCorrect = await this.v$.$validate()

                // if validation returns errors, do nothing
                // if (!isFormCorrect) return
                if (!isFormCorrect) {
                    alert("errors");
                } else {
                    alert("success");
                }

                // otherwise, submit form
                // gather data from form
                // const formDataArray = this.$props.fields;

                // // use proxy to extract since data is observable object (for reactivity)
                // const myProxy = new Proxy(formDataArray, {});

                // // json the data from form
                // const myProxyTarget = JSON.parse(JSON.stringify(myProxy));

                // // prepare data for axios post
                // const data = {};
                // for(let i = 0; i < myProxyTarget.length; i++) {
                //     data[myProxyTarget[i].name] = myProxyTarget[i].value;
                // }

                // const config = {
                //     headers: {
                //         'Content-Type': 'application/json',
                //         'X-Requested-With': 'XMLHttpRequest',
                //         'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                //     }
                // }

                // // submit data to laravel
                // axios.post(this.postroute, data, config)
                //     // .then(response => console.log(response))
                //     .then(response => {
                //         // console.log(response)
                //         window.location.href = '/';
                //     })
                //     .catch(error => console.log(error));
            }
        }
   }
</script>