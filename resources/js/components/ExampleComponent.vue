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
                        <ChildComponent 
                            v-if="displayModal"
                            :message="message" 
                            :modalType="modalType"
                            @close="resetModal">
                        </ChildComponent>
                    </transition>
                    

                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
import ChildComponent from './ChildComponent.vue';
    export default {
        data() {
            return {
                displayModal: false,
                message: '',
                modalType: '',
                fields: '',
            }
        },
        methods: {
            showFormModal() {
                this.displayModal = true;
                this.message = 'form';
                this.modalType = 'form';
                this.fields = '';
            },
            showConfirmationModal() {
                this.displayModal = true;
                this.message = 'confirmation';
                this.modalType = 'confirmation';
                this.fields = '';
            },
            resetModal() {
                this.displayModal = false;
                this.message = '';
                this.modalType = '';
            },
        },
        mounted() {
            console.log("Component mounted.");
        },
        components: { ChildComponent }
    }
</script>
