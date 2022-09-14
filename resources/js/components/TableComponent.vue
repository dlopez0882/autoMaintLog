<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <slot name="card-header">
                        <div class="card-header">My {{ tableName }}</div>
                    </slot>

                    <div class="card-body">
                        <div v-if="!items.length" class="mb-2">No {{ tableName.replaceAll('_', ' ') }} found!</div>

                        <table class="table table-striped task-table">
                            <!-- Table Headings -->
                            <thead>
                                <tr>
                                    <th v-for="column in columns">{{ column.charAt(0).toUpperCase() + column.slice(1) }}</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                            </thead>

                            <!-- Table Body -->
                            <tbody>
                                <tr v-for="item in items" :key="item.id">
                                    <td class="table-text" v-for="column in columns">{{ item[column] }}</td>
                                    <td v-for="option in options">
                                        <a v-if="option == 'view'" :href="tableName + '/' + item.id"
                                            class="btn btn-primary" title="view record">View record</a>

                                        <!-- add option for v-else-if="option == 'edit'" -->
                                        <a v-else-if="option == 'edit'" href="javascript:void(0)" @click="showFormModal(item.id)"
                                            title="edit record"><i class="fa fa-pencil"></i></a>   

                                        <a v-else-if="option == 'delete'" href="javascript:void(0)" @click="showConfirmationModal(item.id)"
                                            title="delete record"><i class="fa fa-trash"></i></a>   
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <button type="button" class="btn btn-primary" :title="`Add ${tableName.slice(0,-1).replaceAll('_', ' ')}`" 
                            @click="showFormModal()">
                            <i class="fa fa-plus"></i> Add {{ tableName.slice(0,-1).replaceAll('_', ' ') }}</button>

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
        </transition>

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
        }
    },
    mounted() {
        console.log("Table component mounted");
    },
    components: { ConfirmationModal, FormModal }
}
</script>