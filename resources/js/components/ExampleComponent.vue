<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <button @click="showFormModal">Form modal</button>
                        <button @click="showConfirmationModal">Confirmation modal</button>
                    </div>

                    <!-- 
                        v-if: boolean to determine if modal should be displayed
                        message: v-bind state data
                     -->
                    <transition name="modal">
                        <ConfirmationModal 
                            v-if="displayConfirmationModal"
                            :message="message" 
                            @close="closeConfirmationModal">
                        </ConfirmationModal>

                        <FormModal
                            v-else-if="displayFormModal"
                            :message="message" 
                            :fields="fields"
                            @close="closeFormModal">
                        </FormModal>
                    </transition>
                    

                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
import ConfirmationModal from './ConfirmationModal.vue';
import FormModal from './FormModal.vue';
    export default {
        data() {
            return {
                displayConfirmationModal: false,
                displayFormModal: false,
                message: '',
                fields: [],
            }
        },
        methods: {
            showFormModal() {
                this.displayFormModal = true;
                this.message = 'This is a form modal';
                this.fields = ['year', 'make', 'model'];
            },
            closeFormModal() {
                this.displayFormModal = false;
                this.message = '';
                this.fields = [];
            },
            showConfirmationModal() {
                this.displayConfirmationModal = true;
                this.message = 'This is a confirmation modal';
            },
            closeConfirmationModal() {
                this.displayConfirmationModal = false;
                this.message = '';
            },
        },
        mounted() {
            console.log("Component mounted.");
        },
        components: { ConfirmationModal, FormModal }
    }
</script>
