<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">My {{ tableName }}</div>

                    <div class="card-body">
                        <div v-if="!items.length" class="mb-2">No {{ tableName }} found!</div>

                        <table class="table table-striped task-table">
                            <!-- Table Headings -->
                            <thead>
                                <tr>
                                    <th v-for="column in columns">{{ column }}</th>
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
                                            class="btn btn-primary" title="view record">View {{item.id}}</a>

                                        <button v-else-if="option == 'delete'" @click="showConfirmationModal()"
                                            type="button" class="btn btn-danger" title="delete record">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <button type="button" class="btn btn-primary" :title="`Add ${tableName.slice(0,-1)}`"
                            @click="showFormModal(`/${tableName}`, `add${tableName.slice(0,-1)}`)"><i
                                class="fa fa-plus"></i> Add {{ tableName.slice(0,-1) }}</button>

                    </div>
                </div>
            </div>
        </div>

        <transition name="modal">
            <ConfirmationModal v-if="displayConfirmationModal" @close="closeConfirmationModal" :table="tableName"
                :method="'delete'"></ConfirmationModal>

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
    },
    methods: {
        showConfirmationModal() {
            this.displayConfirmationModal = true;
        },
        closeConfirmationModal() {
            this.displayConfirmationModal = false;
        },
        showFormModal(postroute, action) {
            this.displayFormModal = true;
            this.postroute = postroute;
            this.action = action;
        },
        closeFormModal() {
            this.displayFormModal = false;
            this.postroute = '';
        }
    },
    mounted() {
        console.log("Table component mounted");
    },
    components: { ConfirmationModal, FormModal }
}
</script>