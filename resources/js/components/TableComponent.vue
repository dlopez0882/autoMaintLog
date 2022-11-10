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
                                        <a v-if="option == 'view'" :href="tableName + '/' + item.id + subdirectory1"
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

                        <b-pagination
                            v-model="ex1CurrentPage"
                            :total-rows="ex1Rows"
                            :per-page="ex1PerPage"
                            first-text="First"
                            prev-text="Prev"
                            next-text="Next"
                            last-text="Last"
                        ></b-pagination>

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
                        :confirmPostUrl="axiosDeleteUrl + itemId"
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
                        :subdirectory1 = "subdirectory1"
                        :axiosCreateUrl="axiosCreateUrl" 
                        :axiosGetUrl="axiosGetUrl"
                        :axiosUpdateUrl="axiosUpdateUrl"
                        :axiosDeleteUrl="axiosDeleteUrl"
                        :redirectUrl="redirectUrl"
                        :ruleSet="ruleSet"
                        :itemId="itemId">
                    </FormModalComponent>

                    <DetailsBodyComponent v-else-if="modalBody == 'recordDetails'" @close="closeModal"
                        :fields="fields"
                        :itemId="itemId"
                        :table="tableName"
                        :axiosGetUrl="axiosGetUrl"
                        :axiosUpdateUrl="axiosUpdateUrl">
                    </DetailsBodyComponent>
                </template>
            </ModalComponent>
        </transition>

    </div>
</template>



<script setup>
import ConfirmationModalComponent from './ConfirmationModalComponent.vue';
import FormModalComponent from './FormModalComponent.vue';
import ModalComponent from './ModalComponent.vue'
import DetailsBodyComponent from './DetailsBodyComponent.vue';
import { 
    uppercaseFirstLetterAndRemoveUnderscores, 
    removeUnderscores, 
    makeSingular, 
    numberFormatter } from '../modules/utilities'
import { ref } from 'vue';

const displayModal = ref(false)
const itemId = ref('')
const modalBody = ref('')

const ex1CurrentPage = ref(1)
const ex1PerPage = ref(10)
const ex1Rows = ref(props.items.length)

const props = defineProps ({
    bootstrapColumns: String,
    items: Object,
    tableName: [String, Number],
    subdirectory1: [String, Number],
    columns: Array,
    options: Array,
    fields: Array,
    hiddenFields: Array,
    axiosCreateUrl: String,
    axiosGetUrl: String,
    axiosUpdateUrl: String,
    axiosDeleteUrl: String,
    redirectUrl: String,
    ruleSet: String,
})

function showModal(id, bodyType) {
    displayModal.value = true;
    itemId.value = id;
    modalBody.value = bodyType;
}

function closeModal() {
    displayModal.value = false;
    itemId.value = '';
    modalBody.value = '';
}

function makeSingularAndRemoveUnderscores(string) {
    return removeUnderscores(makeSingular(string));
}
</script>