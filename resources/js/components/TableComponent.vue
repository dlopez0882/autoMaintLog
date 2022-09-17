<template>
    <div class="container">
        <div class="row justify-content-center">
            <div :class="bootstrapColumns">
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
                                    <th v-for="column in columns" :class="column.css_classes">{{ uppercaseFirstLetterAndRemoveUnderscores(column.name) }}</th>
                                    <th v-for="option in options">&nbsp;</th>
                                </tr>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                                <tr v-for="item in items" :key="item.id">
                                    <td v-for="column in columns" :class="column.css_classes">{{ numberFormatter(item[column.name], [column.format]) }}</td>
                                    <td v-for="option in options">
                                        <a v-if="option == 'view'" :href="tableName + '/' + item.id"
                                            title="view record"><i class="fa fa-list"></i></a>

                                        <a v-else-if="option == 'view-modal'" href="javascript:void(0)"
                                            @click="showModal(item.id, 'recordDetails')" title="view record" @keydown.esc="displayModal=false"><i class="fa fa-info"></i></a>

                                        <a v-else-if="option == 'edit'" href="javascript:void(0)" @click="showModal(item.id, 'form')"
                                            title="edit record" @keydown.esc="displayModal=false"><i class="fa fa-pencil"></i></a>   

                                        <a v-else-if="option == 'delete'" href="javascript:void(0)" @click="showModal(item.id, 'confirmation')"
                                            title="delete record" @keydown.esc="displayModal=false"><i class="fa fa-trash"></i></a>   
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <button type="button" class="btn btn-primary" :title="`Add ${makeSingularAndRemoveUnderscores(tableName)}`" 
                            @click="showModal('', 'form')"
                            @keydown.esc="displayModal=false">
                            <i class="fa fa-plus"></i> Add {{ makeSingularAndRemoveUnderscores(tableName) }}</button>

                    </div>
                </div>
            </div>
        </div>

        <transition name="modal">
            <ModalComponent v-if="displayModal">
                <template v-slot:body>
                    <ConfirmationModalComponent v-if="modalBody == 'confirmation'" @close="closeModal"
                        :table="tableName" 
                        :confirmPostUrl="deleteConfirmPostUrl + itemId"
                        :method="'delete'">
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
                    </ConfirmationModalComponent>

                    <FormModalComponent v-else-if="modalBody == 'form'" @close="closeModal" 
                        :table="tableName" 
                        :fields="fields"
                        :hiddenFields="hiddenFields"
                        :axiosFormPostUrl="axiosFormPostUrl" 
                        :axiosUpdateUrl="axiosUpdateUrl"
                        :redirectUrl="redirectUrl"
                        :ruleSet="ruleSet"
                        :deleteConfirmPostUrl="deleteConfirmPostUrl"
                        :itemId="itemId">
                    </FormModalComponent>

                    <DetailsBodyComponent v-else-if="modalBody == 'recordDetails'" @close="closeModal"
                        :fields="fields"
                        :itemId="itemId"
                        :table="tableName">
                    </DetailsBodyComponent>
                </template>
            </ModalComponent>
        </transition>

    </div>
</template>



<script>
import ConfirmationModalComponent from './ConfirmationModalComponent.vue';
import FormModalComponent from './FormModalComponent.vue';
import ModalComponent from './ModalComponent.vue'
import DetailsBodyComponent from './DetailsBodyComponent.vue';
import { 
    uppercaseFirstLetterAndRemoveUnderscores, 
    removeUnderscores, 
    makeSingular, 
    numberFormatter } from '../modules/utilities'

export default {
    data() {
        return {
            displayModal: false,
            itemId: '',
            modalBody: '',
        };
    },
    props: {
        bootstrapColumns: String,
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
        showModal(id, modalBody) {
            this.displayModal = true;
            this.itemId = id;
            this.modalBody = modalBody;
        },
        closeModal() {
            this.displayModal = false;
            this.itemId = '';
            this.modalBody = '';
        },
        uppercaseFirstLetterAndRemoveUnderscores(string) {
            return uppercaseFirstLetterAndRemoveUnderscores(string);
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
    components: { ConfirmationModalComponent, FormModalComponent, ModalComponent, DetailsBodyComponent }
}
</script>