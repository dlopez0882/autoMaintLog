<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <p><button @click="showFormModal('vehicle')">Add Vehicle Form modal</button></p>
                        <p><button @click="showConfirmationModal">Delete Vehicle Confirmation modal</button></p>

                        <p><button @click="showFormModal('service_item')">Add Service Item Form modal</button></p>
                        <p><button @click="showConfirmationModal">Delete Service Item Confirmation modal</button></p>
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
                            <template v-slot:header>
                                <h3>Confirm</h3>
                            </template>
                        </ConfirmationModal>

                        <FormModal
                            v-else-if="displayFormModal"
                            :headerString="headerString" 
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
                headerString: '',
                message: '',
                fields: [],
            }
        },
        methods: {
            showFormModal(type) {
                this.displayFormModal = true;
                this.headerString = type.replaceAll('_', ' ');
                this.fields = ['year', 'make', 'model'];
            },
            closeFormModal() {
                this.displayFormModal = false;
                this.headerString = '';
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
