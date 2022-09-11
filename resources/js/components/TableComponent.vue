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
                                        <button v-else-if="option == 'delete'" @click="showConfirmationModal(`/${tableName.replaceAll('_','')}/${item.id}`)"
                                            type="button" class="btn btn-danger" title="delete record">Delete record</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <button type="button" class="btn btn-primary" :title="`Add ${tableName.slice(0,-1).replaceAll('_', ' ')}`" 
                            @click="showFormModal(`/${tableName.replaceAll('_', '')}`, `add${tableName.slice(0,-1)}`)"><i 
                                class="fa fa-plus"></i> Add {{ tableName.slice(0,-1).replaceAll('_', ' ') }}</button>

                    </div>
                </div>
            </div>
        </div>

        <transition name="modal">
            <ConfirmationModal v-if="displayConfirmationModal" @close="closeConfirmationModal" :table="tableName" :postroute="postroute"
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

            <FormModal v-else-if="displayFormModal" @close="closeFormModal" :table="tableName" :fields="fields"
                :postroute="postroute" :action="action"></FormModal>
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
            postroute: '',
            action: '',
        };
    },
    props: {
        items: Object,
        tableName: [String, Number],
        columns: Array,
        options: Array,
        fields: Array,
        hiddenFields: Array,
    },
    methods: {
        showConfirmationModal(postroute) {
            this.displayConfirmationModal = true;
            this.postroute = postroute;
        },
        closeConfirmationModal() {
            this.displayConfirmationModal = false;
            this.postroute = ''
        },
        showFormModal(postroute, action) {
            this.displayFormModal = true;
            this.postroute = postroute;
            this.action = action;
        },
        closeFormModal() {
            this.displayFormModal = false;
            this.postroute = '';
            this.action = '';
        }
    },
    mounted() {
        console.log("Table component mounted");
    },
    components: { ConfirmationModal, FormModal }
}
</script>