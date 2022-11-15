<template>
    <div class="container">
        <div class="row justify-content-center">
            <div :class="bootstrapColumns">
                <slot name="breadcrumb"></slot>
            </div>
        </div>

        <div class="row justify-content-center">
            <div :class="bootstrapColumns">
                <div class="card">
                    <div class="card-header">
                        <div class="row d-flex align-items-center">
                            <div class="col-sm-8">{{ tableHeader }}</div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-sm btn-primary float-end full-width" :title="`Add ${makeSingularAndRemoveUnderscores(tableName)}`" 
                                        @click="showModal('', 'form')"
                                        @keydown.esc="displayModal=false">
                                        <i class="fa fa-plus"></i> Add {{ makeSingularAndRemoveUnderscores(tableName) }}</button>  
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <SearchComponent
                            :styleClass="`col-6 float-end`"
                            :placeholder="`${makeSingularAndRemoveUnderscores(tableName)} search`"
                        ></SearchComponent>
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
                                <tr v-for="item in paginatedItems" :key="item.id">
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

                        <!-- paginator -->
                        <div class="row justify-content-end">
                            <div v-if="items.length > perPage" class="col-sm-6">
                                <b-pagination
                                    v-model="currentPage"
                                    :total-rows="items.length"
                                    :per-page="perPage"
                                    align="end"
                                ></b-pagination>
                            </div>
                        </div>
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
import SearchComponent from './SearchComponent.vue';
import { 
    uppercaseFirstLetterAndRemoveUnderscores, 
    removeUnderscores, 
    makeSingular, 
    numberFormatter } from '../modules/utilities'
import { computed, ref } from 'vue';

const displayModal = ref(false)
const itemId = ref('')
const modalBody = ref('')
const currentPage = ref(1)
const perPage = ref(10)

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
    tableHeader: String,
})

const paginatedItems = computed(() => {
    const start = (currentPage.value - 1) * perPage.value;
    const end = currentPage.value * perPage.value;

    return props.items.slice(start, end);
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