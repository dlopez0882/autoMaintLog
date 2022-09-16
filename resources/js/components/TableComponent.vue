<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="card">
                    <slot name="card-header">
                        <div class="card-header">My {{ tableName }}</div>
                    </slot>

                    <div class="card-body">
                        <slot name="return-link"></slot>
                        <div v-if="!items.length" class="mt-2 mb-2">No {{ removeUnderscores(tableName) }} found!</div>

                        <table v-else class="table table-striped task-table">
                            <!-- Table Headings -->
                            <thead>
                                <tr>
                                    <th v-for="column in columns">{{ uppercaseFirstLetterAndRemoveUnderscores(column.name) }}</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                                <tr v-for="item in items" :key="item.id">
                                    <td class="table-text" v-for="column in columns">{{ numberFormatter(item[column.name], [column.format]) }}</td>
                                    <td v-for="option in options">
                                        <a v-if="option == 'view'" :href="tableName + '/' + item.id"
                                            class="btn btn-primary" title="view record">View record</a>

                                        <a v-else-if="option == 'view-modal'" href="javascript:void(0)"
                                            @click="showModal(item.id)" title="view record"><i class="fa fa-info"></i></a>

                                        <!-- add option for v-else-if="option == 'edit'" -->
                                        <a v-else-if="option == 'edit'" href="javascript:void(0)" @click="showFormModal(item.id)"
                                            title="edit record"><i class="fa fa-pencil"></i></a>   

                                        <a v-else-if="option == 'delete'" href="javascript:void(0)" @click="showConfirmationModal(item.id)"
                                            title="delete record"><i class="fa fa-trash"></i></a>   
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <button type="button" class="btn btn-primary" :title="`Add ${makeSingularAndRemoveUnderscores(tableName)}`" 
                            @click="showFormModal()">
                            <i class="fa fa-plus"></i> Add {{ makeSingularAndRemoveUnderscores(tableName) }}</button>

                    </div>
                </div>
            </div>
        </div>

        <transition name="modal">
            <ConfirmationModal v-if="displayConfirmationModal" @close="closeConfirmationModal" 
                :table="tableName" 
                :confirmPostUrl="deleteConfirmPostUrl + itemId"
                :method="'delete'">
                <template v-slot:header><h3>Confirm</h3></template>

                <!--
                    add extra hidden fields as needed
                    ex. modals that require redirecting to a specific page 
                -->
                <template v-slot:hiddenfields>
                    <input v-for="field of hiddenFields"
                    type="hidden" 
                    :name="field.name" 
                    :value="field.value">
                </template>
            </ConfirmationModal>

            <FormModal v-else-if="displayFormModal" @close="closeFormModal" 
                :table="tableName" 
                :fields="fields"
                :hiddenFields="hiddenFields"
                :axiosFormPostUrl="axiosFormPostUrl" 
                :axiosUpdateUrl="axiosUpdateUrl"
                :redirectUrl="redirectUrl"
                :ruleSet="ruleSet"
                :deleteConfirmPostUrl="deleteConfirmPostUrl"
                :itemId="itemId">
            </FormModal>

            <Modal v-else-if="displayModal" @close="closeModal">
                <template v-slot:header>
                    {{ uppercaseFirstLetterAndMakeSingularAndRemoveUnderscores(tableName) }} details
                </template>

                <template v-slot:body>
                    <DetailsBody
                        :fields="fields"
                        :itemId="itemId">
                    </DetailsBody>
                </template>
            </Modal>
        </transition>

    </div>
</template>



<script>
import ConfirmationModal from './ConfirmationModal.vue';
import FormModal from './FormModal.vue';
import Modal from './Modal.vue'
import DetailsBody from './DetailsBody.vue';
import { 
    uppercaseFirstLetterAndRemoveUnderscores, 
    uppercaseFirstLetterAndMakeSingularAndRemoveUnderscores,
    removeUnderscores, 
    makeSingular, 
    numberFormatter } from '../modules/utilities'

export default {
    data() {
        return {
            displayConfirmationModal: false,
            displayFormModal: false,
            displayModal: false,
            itemId: '',
        };
    },
    props: {
        items: Object,
        tableName: [String, Number],
        columns: Array,
        options: Array,
        fields: Array,
        hiddenFields: Array,
        axiosFormPostUrl: String,
        axiosUpdateUrl: String,
        redirectUrl: String,
        ruleSet: String,
        deleteConfirmPostUrl: String,
    },
    methods: {
        showConfirmationModal(id) {
            this.displayConfirmationModal = true;
            this.itemId = id;
        },
        closeConfirmationModal() {
            this.displayConfirmationModal = false;
            this.itemId = '';
        },
        showFormModal(id=null) {
            this.displayFormModal = true;
            if(id) {
                this.itemId = id;
            }
        },
        closeFormModal() {
            this.displayFormModal = false;
            if(this.itemId) {
                this.itemId = '';
            }
        },
        showModal(id) {
            this.displayModal = true;
            this.itemId = id;
        },
        closeModal() {
            this.displayModal = false;
            this.itemId = '';
        },
        uppercaseFirstLetterAndRemoveUnderscores(string) {
            return uppercaseFirstLetterAndRemoveUnderscores(string);
        },
        uppercaseFirstLetterAndMakeSingularAndRemoveUnderscores(string) {
            return uppercaseFirstLetterAndMakeSingularAndRemoveUnderscores(string);
        },
        removeUnderscores(string) {
            return removeUnderscores(string);
        },
        makeSingularAndRemoveUnderscores(string) {
            return removeUnderscores(makeSingular(string));
        },
        numberFormatter(value, format) {
            return numberFormatter(value, format);
        },
    },
    mounted() {
        console.log("Table component mounted");
    },
    components: { ConfirmationModal, FormModal, Modal, DetailsBody }
}
</script>