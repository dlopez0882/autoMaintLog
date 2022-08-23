<script>
    import useVuelidate from '@vuelidate/core';
    import { required } from '@vuelidate/validators';
    import axios from 'axios';

    export default {
        setup () {
            return { 
                v$: useVuelidate()
            }
        },
        data () {
            return {
                vehicleid: "",
                date: "",
                mileage: "",
                services: "",
                technician: "",
                cost: ""
            }
        },

        // vuelidate validation rules
        validations () {
            return {
                date: { required },
                mileage: { required },
                services: { required },
                technician: { required },
                cost: { required }
            }
        },
        methods: {
            async submitForm () {
                const isFormCorrect = await this.v$.$validate()

                // if validation returns errors, do nothing
                if (!isFormCorrect) return

                // otherwise, submit form
                // gather data from form
                const workItemProps = {
                    vehicle_id: this.$attrs.data.vehicleid,
                    date: this.$refs.date.value, 
                    mileage: this.$refs.mileage.value, 
                    services: this.$refs.services.value,
                    technician: this.$refs.technician.value, 
                    cost: this.$refs.cost.value
                }

                // json the data from form
                const data = JSON.stringify({workItemProps})
                const config = {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }

                // submit data to laravel
                axios.post('../addworkitem', data, config)
                    // .then(response => console.log(response))
                    .then(response => {
                        // console.log(response)
                        window.location.href = '/vehicle/' + workItemProps.vehicle_id;
                    })
                    .catch(error => console.log(error));
            }
        }
    }
</script>

<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container3">
                <div class="card">
                    <div class="card-header">
                        <slot name="header">
                            Add a New Work Item
                        </slot>
                    </div>

                    <div class="card-body">
                        <slot name="body">
                            <form action="submitForm" method="POST">
                                <div class="mb-3">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" id="date" class="form-control" v-model="date" ref="date">
                                    <div class="text-danger" v-if="v$.date.$error">Date field is required.</div>                              
                                </div>

                                <div class="mb-3">
                                    <label for="mileage">Mileage</label>
                                    <input type="number" name="mileage" id="mileage" class="form-control" v-model="mileage" ref="mileage">
                                    <div class="text-danger" v-if="v$.mileage.$error">Mileage field is required.</div>
                                </div>

                                <div class="mb-3">
                                    <label for="services">Service item(s)</label>
                                    <input type="text" name="services" id="services" class="form-control" v-model="services" ref="services">
                                    <div class="text-danger" v-if="v$.services.$error">Service item(s) field is required.</div>                          
                                </div>

                                <div class="mb-3">
                                    <label for="technician">Performed by</label>
                                    <input type="text" name="technician" id="technician" class="form-control" v-model="technician" ref="technician">
                                    <div class="text-danger" v-if="v$.technician.$error">Performed by field is required.</div>    
                                </div>

                                <div class="mb-3">
                                    <label for="cost">Cost</label>
                                    <input type="number" step=0.01 name="cost" id="cost" class="form-control" v-model="cost" ref="cost">
                                    <div class="text-danger" v-if="v$.cost.$error">Cost field is required.</div>    
                                </div>

                                <div class="text-end">
                                    <slot name="footer">
                                        <button type="button" class="btn btn-light me-2" @click="$emit('close')">
                                            Cancel
                                        </button>

                                        <button class="btn btn-primary" @click.prevent="submitForm"><i class="fa fa-plus"></i> Add Work Item</button>
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

<style>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: table;
    transition: opacity 0.3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.modal-container3 {
    width: 800px;
    margin: 0px auto;
    padding: 20px 30px;
    background-color: #fff;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
    transition: all 0.3s ease;
    /* font-family: Helvetica, Arial, sans-serif; */
}

.modal-header h3 {
    margin-top: 0;
    color: #42b983;
}

.modal-body {
    margin: 20px 0;
}

.modal-default-button {
    float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter-from,
.modal-leave-to {
    opacity: 0;
}

.modal-enter-active .modal-container,
.modal-leave-active .modal-container {
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}
</style>