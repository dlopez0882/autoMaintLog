<template>
    <div class="modal-mask">
        <div class="modal-wrapper">
            <div class="modal-container modal-container-form">
                <div class="card">
                    <div class="card-header">
                        <slot name="header">
                            Add a new {{ table.slice(0,-1) }}
                        </slot>
                    </div>

                    <div class="card-body">
                        <slot name="body">
                            <form id="formModal" action="submitForm" method="POST">
                                <!-- hidden fields -->
                                <input v-for="field in hiddenFields" :key="field.name" 
                                    :name="field.name"
                                    type="hidden"
                                    :value="field.value">

                                <!-- visible fields -->
                                <div v-for="field in fields" :key="field.name" class="mb-3">
                                    <label :for="field.name">{{ field.name.charAt(0).toUpperCase() + field.name.slice(1) }}</label>
                                    <!-- if type is "tinymce", inject tinymce component -->
                                    <editor v-if="field.type == 'tinymce'" 
                                        api-key="no-api-key"
                                        v-model="state[field.name]"
                                        :init="{
                                            height: 150,
                                            menubar: false,
                                            plugins: 'link autolink lists',
                                            toolbar: 'styles bold italic numlist bullist link',
                                            branding: false,
                                        }">
                                    </editor>
                                    <input v-else :type="field.type" :name="field.name" :id="field.name" class="form-control"
                                        v-model="state[field.name]">
                                </div>
                                <div class="text-danger" v-for="error of v$.$errors" :key="error.$uid">{{ error.$message
                                }}</div>
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
import { between, helpers, required } from '@vuelidate/validators';
import axios from 'axios';
import { reactive } from 'vue';
import Editor from '@tinymce/tinymce-vue';

export default {
    setup(props) {
        const state = reactive({
            // year: '',
            // make: '',
            // model: ''
        })

        const rules = computed(() => {
            if (props.ruleSet == 'addvehicle') {
                return {
                    year: {
                        between: between(1900, new Date().getFullYear() + 1),
                        required: helpers.withMessage('Year field is required', required)
                    },
                    make: { required: helpers.withMessage('Make field is required', required) },
                    model: { required: helpers.withMessage('Model field is required', required) }
                }
            } else if (props.ruleSet == 'addserviceitem') {
                return {
                    date: { required: helpers.withMessage('Date field is required', required) },
                    mileage: { required: helpers.withMessage('Mileage field is required', required) },
                    service_summary: { required: helpers.withMessage('Service summary field is required', required) },
                    technician: { required: helpers.withMessage('Technician field is required', required) },
                    cost: { required: helpers.withMessage('Cost field is required', required) }
                }
            }
        })

        const v$ = useVuelidate(rules, state)

        return { state, v$ }
    },
    props: {
        table: String,
        fields: Object,
        axiosPostUrl: String,
        hiddenFields: Object,
        redirectUrl: String,
        ruleSet: String,
    },
    components: {
        'editor': Editor
    },
    methods: {
        async submitForm() {
            const isFormCorrect = await this.v$.$validate()

            // if validation returns errors, do nothing
            if (!isFormCorrect) return

            // otherwise, submit form
            // gather data from form
            const formDataArray = this.state;

            // use proxy to extract since data is observable object (for reactivity)
            const myProxy = new Proxy(formDataArray, {});

            // json the data from form
            const data = JSON.parse(JSON.stringify(myProxy));

            // if there are hidden fields, add them to data array
            const hiddenFields = document.getElementById('formModal').querySelectorAll('input[type="hidden"]');
            if(hiddenFields.length > 0)
                hiddenFields.forEach(element => data[element.name] = element.value);
            
            const config = {
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN' : document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }

            // submit data to laravel
            axios.post(this.axiosPostUrl, data, config)
                .then(response => {
                    // console.log(response)
                    window.location.href = this.redirectUrl;
                })
                .catch(error => console.log(error));
        }
    }
}
</script>