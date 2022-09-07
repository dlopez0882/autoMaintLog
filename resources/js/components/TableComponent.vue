<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My {{ tableName }}</div>

                <div class="card-body">
                    <!-- @if($vehicles->count() == 0) -->
                    <div v-if="!items.length" class="mb-2">No {{ tableName }} found!</div>

                    <!-- @else -->
                    <table class="table table-striped task-table">
                        <!-- Table Headings -->
                        <thead>
                            <tr>
                                <!-- <th v-for="(column, index) in columns" :key="index">{{ column }}</th> -->
                                <th v-for="column in columns">{{ column }}</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                            
                        </thead>
    
                        <!-- Table Body -->
                        <tbody>
                            <!-- @foreach ($vehicles as $vehicle)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ $vehicle->year . " " . $vehicle->make . " " . $vehicle->model }}</div>
                                    </td> -->
                                <tr v-for="item in items" :key="item.id">
                                    <td class="table-text" v-for="column in columns">{{ item[column] }}</td>


                                    <!-- Show records button button -->
                                    <!-- <td>
                                        <a href="{{ url("/vehicles/{$vehicle->id}") }}" class="btn btn-primary" title="See Service History"><i class="fa fa-gear"></i> See Service History</a>
                                    </td> -->
    
                                    <!-- Button to open delete confirmation modal -->
                                    <!-- <td>
                                        <button 
                                            id="show-modal" 
                                            class="btn btn-danger" 
                                            title="Delete Vehicle"
                                            @click="showModal = true, vehicle={{ json_encode($vehicle) }}, postroute='{{ url("/vehicles/{$vehicle->id}") }}'"
                                            @keydown.esc="showModal = false" 
                                        >
                                        <i class="fa fa-trash"></i> Delete Vehicle</button>
                                    </td> -->

                                    <td v-for="option in options">
                                        <a v-if="option == 'view'" :href="tableName + '/' + item.id" class="btn btn-primary" title="view record">View {{item.id}}</a>
                                        <!-- <button v-else-if="option == 'delete'" type="button" class="btn btn-danger" title="delete record">Delete</button> -->

                                        <button v-else-if="option == 'delete'" @click="showConfirmationModal()" type="button" class="btn btn-danger" title="delete record">Delete</button>
                                    </td>

                                </tr>
                            <!-- @endforeach -->
                        </tbody>
                    </table>
                    <!-- @endif -->
                    
                    <!-- <button 
                        type="button"
                        id="show-add-vehicle-modal"
                        class="btn btn-primary"
                        title="Add Vehicle"
                        @click="showAddVehicleModal = true, postroute='{{ url("/vehicles") }}'"
                        @keydown.esc="showAddVehicleModal = false" 
                    > -->
                    <!-- <button
                        type="button"
                        class="btn btn-primary"
                        title="Add"
                        @click="showAddVehicleModal = true, postroute=tableName + '/'"
                    ><i class="fa fa-plus"></i> Add {{ tableName }}</button> -->

                    <button
                        type="button"
                        class="btn btn-primary"
                        title="Add"
                        @click="showFormModal({'year':'number', 'make':'text', 'model':'text'})"
                    ><i class="fa fa-plus"></i> Add {{ tableName }}</button>

                </div>
            </div>
        </div>
    </div>

    <transition name="modal">
        <!-- <add-vehicle-modal-component 
            v-if="showAddVehicleModal" 
            @close="showAddVehicleModal = false" 
            v-bind:data = "{postroute:postroute}"
        >
        </add-vehicle-modal-component> -->

        <!-- <component :is=currentComponent
        v-if="showAddVehicleModal" 
            @close="showAddVehicleModal = false" 
            v-bind:data = "{postroute:postroute}"
        ></component> -->

        <ConfirmationModal
            v-if="displayConfirmationModal"
            @close="closeConfirmationModal"
            :table="tableName"
            :method="'delete'"
        ></ConfirmationModal>

        <FormModal
            v-else-if="displayFormModal"
            @close="closeFormModal"
            :table="tableName"
            :fields="fields"
        ></FormModal>
    </transition>

</div>
</template>



<script>
    import ConfirmationModal from './ConfirmationModal.vue';
    import FormModal from './FormModal.vue';

    export default {
        data() {
            return {
                showAddVehicleModal: false,
                currentComponent: this.$props.inputmodal,

                displayConfirmationModal: false,
                displayFormModal: false,
                fields: '',
            };
        },
        props: {
            items: Object,
            tableName: [String, Number],
            columns: Array,
            options: Array,
            inputmodal: String,
        },
        methods: {
            showConfirmationModal() {
                this.displayConfirmationModal = true;
            },
            closeConfirmationModal() {
                this.displayConfirmationModal = false;
            },
            showFormModal(fields) {
                this.displayFormModal = true;
                this.fields = fields;
            },
            closeFormModal() {
                this.displayFormModal = false;
                this.fields = '';
            }
        },
        mounted() {
            console.log("Table component mounted");
            console.log(this.$props.inputmodal);
        },
        components: { ConfirmationModal, FormModal }
    }
</script>