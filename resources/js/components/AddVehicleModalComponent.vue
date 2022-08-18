<script>
    import { reactive } from 'vue';
    import useVuelidate from '@vuelidate/core';
    import { required } from '@vuelidate/validators';

    export default {
        setup () {
            return { 
                v$: useVuelidate() 
            }
        },
        data () {
            return {
                year: "",
                // make: "",
                // model: "",
                data: this.$attrs.data,
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        },
        validations () {
            return {
                year: { required }, // Matches this.year
                // make: { required }, // Matches this.make
                // model: { required }, // Matches this.make
            }
        },
        methods: {
            async submitForm () {
            const isFormCorrect = await this.v$.$validate()
            // you can show some extra alert to the user or just leave the each field to show it's `$errors`.
            if (!isFormCorrect) return
            // actually submit form
                console.log(this.$refs.year.value);
            }
        }
    }
</script>

<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container2">
                <div class="card">
                    <div class="card-header">
                        <slot name="header">
                            Add a New Vehicle
                        </slot>
                    </div>

                    <div class="card-body">
                        <slot name="body">
                            <!-- <form :action="`${data.postroute}`" method="POST"> -->
                            <form action="submitForm" method="POST">
                                <input type="hidden" name="_token" :value="csrf">
                                <div class="mb-3">
                                    <label for="year">Year
                                        <input type="number" name="year" id="year" class="form-control" v-model="year" ref="year">
                                        <div v-if="v$.year.$error">Year field has an error.</div>
                                    </label>
                                </div>

                                <!-- <div class="mb-3">
                                    <label for="make">Make
                                        <input type="text" name="make" id="make" class="form-control" v-model="make">
                                        <div v-if="v$.make.$error">Make field has an error.</div>
                                    </label>
                                </div>

                                <div class="mb-3">
                                    <label for="model">Model
                                        <input type="text" name="model" id="model" class="form-control" v-model="model">
                                        <div v-if="v$.model.$error">Model field has an error.</div>
                                    </label>
                                </div> -->

                                <div class="text-end">
                                    <slot name="footer">
                                        <button type="button" class="btn btn-light me-2" @click="$emit('close')">
                                            Cancel
                                        </button>

                                        <!-- <button type="submit" class="btn btn-danger">
                                            OK
                                        </button> -->
                                        <button @click.prevent="submitForm">Add person</button>
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

.modal-container2 {
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