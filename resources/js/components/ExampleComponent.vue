<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <p><button @click="showFormModal('vehicle', ['year', 'make', 'model'])">Add Vehicle Form modal</button></p>
                        <p><button @click="showConfirmationModal('vehicles', 'delete')">Delete Vehicle Confirmation modal</button></p>

                        <p><button @click="showFormModal('service_item', ['date', 'mileage', 'technician', 'cost', 'service_summary', 'service_details'])">Add Service Item Form modal</button></p>
                        <p><button @click="showConfirmationModal('service_items', 'delete')">Delete Service Item Confirmation modal</button></p>
                    </div>

                    <!-- 
                        v-if: boolean to determine if modal should be displayed
                        message: v-bind state data
                     -->
                    <transition name="modal">
                        <ConfirmationModal 
                            v-if="displayConfirmationModal"
                            :table="table"
                            :method="method" 
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
                fields: [],
                table: '',
                method: '',
            }
        },
        methods: {
            showFormModal(type, fields) {
                this.displayFormModal = true;
                this.headerString = type.replaceAll('_', ' ');
                this.fields = fields;
            },
            closeFormModal() {
                this.displayFormModal = false;
                this.headerString = '';
                this.fields = [];
            },
            showConfirmationModal(table, method) {
                this.displayConfirmationModal = true;
                this.table = table;
                this.method = method;
            },
            closeConfirmationModal() {
                this.displayConfirmationModal = false;
                this.table = '';
                this.method = '';
            },
        },
        mounted() {
            console.log("Component mounted.");
        },
        components: { ConfirmationModal, FormModal }
    }
</script>
