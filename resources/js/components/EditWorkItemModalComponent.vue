<script>
    import useVuelidate from '@vuelidate/core';
    import { required } from '@vuelidate/validators';
    import axios from 'axios';
    import Editor from '@tinymce/tinymce-vue';

    export default {
        setup () {
            return { 
                v$: useVuelidate(),
            }
        },
        data () {
            return {
                results: [],
            }
        },
        // vuelidate validation rules
        validations () {
            return {
                results: {
                    service_date: {
                        required
                    },
                    mileage: { 
                        required
                    },
                    technician: {
                        required
                    },
                    cost: {
                        required
                    },
                    service_summary: {
                        required
                    },
                }
            }
        },
        components: {
            'editor': Editor
        },
        mounted () {
            let workItemID = this.$attrs.data.workItemID;
            axios.get('../workitems/' + workItemID)
            .then(response => {
                // console.log(response)
                this.results = response.data
            })
            .catch(error => console.log(error));
        },
        methods: {
            async submitForm () {
                let workItemID = this.$attrs.data.workItemID;
                let vehicleID = this.$attrs.data.vehicleid;
                const isFormCorrect = await this.v$.$validate()

                // if validation returns errors, do nothing
                if (!isFormCorrect) return

                // otherwise, submit form
                // gather data from form
                const workItemProps = {
                    workItemID: workItemID,
                    date: this.results.service_date, 
                    mileage: this.results.mileage,
                    service_summary: this.results.service_summary,
                    service_details: (this.results.service_details) ? this.results.service_details : "n/a",
                    technician: this.results.technician, 
                    cost: this.results.cost
                }

                // json the data from form
                const data = JSON.stringify({workItemProps})
                // console.log(data);
                const config = {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }

                // submit data to laravel
                axios.post('../updateworkitem/' + workItemID, data, config)
                    // .then(response => console.log(response))
                    .then(response => {
                        // console.log(response)
                        window.location.href = '/vehicles/' + vehicleID;
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
                            Edit Work Item
                        </slot>
                    </div>

                    <div class="card-body">
                        <slot name="body">
                            <form action="submitForm" method="POST">
                                <div class="mb-3">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" v-model="results.service_date" ref="date">
                                    <div class="text-danger" v-if="v$.results.service_date.$error">Date field is required.</div>                              
                                </div>

                                <div class="mb-3">
                                    <label for="mileage">Mileage</label>
                                    <input type="number" name="mileage" id="mileage" class="form-control" v-model="results.mileage" ref="mileage">
                                    <div class="text-danger" v-if="v$.results.mileage.$error">Mileage field is required.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="technician">Performed by</label>
                                    <input type="text" name="technician" id="technician" class="form-control" v-model="results.technician" ref="technician">
                                    <div class="text-danger" v-if="v$.results.technician.$error">Performed by field is required.</div>    
                                </div>

                                <div class="mb-3">
                                    <label for="cost">Cost</label>
                                    <input type="number" step=0.01 name="cost" id="cost" class="form-control" v-model="results.cost" ref="cost">
                                    <div class="text-danger" v-if="v$.results.cost.$error">Cost field is required.</div>    
                                </div>

                                <div class="mb-3">
                                    <label for="service_summary">Service summary</label>
                                    <input type="text" name="service_summary" id="service_summary" class="form-control" v-model="results.service_summary" ref="service_summary">
                                    <div class="text-danger" v-if="v$.results.service_summary.$error">Service summary field is required.</div>                          
                                </div>

                                <div class="mb-3">
                                    <label for="service_details">Service details</label>
                                    <editor 
                                        api-key="no-api-key"
                                        v-model="results.service_details" 
                                        ref="service_details"
                                        :init="{
                                            height: 150,
                                            menubar: false,
                                            plugins: 'link autolink lists',
                                            toolbar: 'styles bold italic numlist bullist link',
                                            branding: false,
                                        }">
                                    </editor>
                                </div>

                                <div class="text-end">
                                    <slot name="footer">
                                        <button type="button" class="btn btn-light me-2" @click="$emit('close')">
                                            Cancel
                                        </button>

                                        <button class="btn btn-primary" @click.prevent="submitForm">Edit Work Item</button>
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