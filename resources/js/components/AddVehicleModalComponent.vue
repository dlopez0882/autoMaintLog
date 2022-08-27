<script>
    import useVuelidate from '@vuelidate/core';
    import { between, required } from '@vuelidate/validators';
    import axios from 'axios';

    export default {
        setup () {
            return { 
                v$: useVuelidate(),
                yearMin: 1900,
                yearMax: new Date().getFullYear() + 1
            }
        },
        data () {
            return {
                year: "",
                make: "",
                model: ""
            }
        },

        // vuelidate validation rules
        validations () {
            return {
                year: { 
                    between: between(this.yearMin, this.yearMax),
                    required 
                },
                make: { required },
                model: { required },
            }
        },
        methods: {
            async submitForm () {
                const isFormCorrect = await this.v$.$validate()

                // if validation returns errors, do nothing
                if (!isFormCorrect) return

                // otherwise, submit form
                // gather data from form
                const vehicleProps = {
                    year: this.$refs.year.value, 
                    make: this.$refs.make.value, 
                    model: this.$refs.model.value
                }

                // json the data from form
                const data = JSON.stringify({vehicleProps})
                const config = {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }

                // submit data to laravel
                axios.post('addvehicle', data, config)
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

<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container modal-container-form">
                <div class="card">
                    <div class="card-header">
                        <slot name="header">
                            Add a New Vehicle
                        </slot>
                    </div>

                    <div class="card-body">
                        <slot name="body">
                            <form action="submitForm" method="POST">

                                <div class="mb-3">
                                    <label for="year">Year</label>
                                    <input type="number" name="year" id="year" class="form-control" placeholder="ex: 2000" v-model="year" ref="year">
                                    <div class="text-danger" v-if="v$.year.$error">Year field is required and must be between {{ yearMin }} and {{ yearMax }}.</div>                              
                                </div>

                                <div class="mb-3">
                                    <label for="make">Make</label>
                                    <input type="text" name="make" id="make" class="form-control" placeholder="ex: Honda" v-model="make" ref="make">
                                    <div class="text-danger" v-if="v$.make.$error">Make field is required.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="model">Model</label>
                                    <input type="text" name="model" id="model" class="form-control" placeholder="ex: Civic" v-model="model" ref="model">
                                    <div class="text-danger" v-if="v$.model.$error">Model field is required.</div>                          
                                </div>

                                <div class="text-end">
                                    <slot name="footer">
                                        <button type="button" class="btn btn-light me-2" @click="$emit('close')">
                                            Cancel
                                        </button>

                                        <button class="btn btn-primary" @click.prevent="submitForm"><i class="fa fa-plus"></i> Add Vehicle</button>
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