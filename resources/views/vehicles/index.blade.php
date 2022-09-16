@extends('layouts.app')

@section('content')

<table-component
        :items="{{ $workOrders }}"
        :table-name="'service_items'"
        {{-- :columns to be used for table column data --}}
        :columns="[
            {'name': 'service_date'},
            {'name': 'mileage', 'format': 'number'}, 
            {'name': 'service_summary'},
            {'name': 'technician'},
            {'name': 'cost', 'format': 'currency'}
        ]"
        :options="['view-modal', 'edit', 'delete']"
        {{-- :fields to be used for modals --}}
        :fields="[
            {'name': 'service_date', 'type': 'date'},
            {'name': 'mileage', 'type': 'number', 'format': 'number'},
            {'name': 'technician', 'type': 'text'},
            {'name': 'cost', 'type': 'number', 'format': 'currency'},
            {'name': 'service_summary', 'type': 'text'},
            {'name': 'service_details', 'type': 'tinymce'}
        ]"
        :hidden-fields="[
            {'name': 'vehicle_id', 'value': {{ $vehicleData->id }}}
        ]"
        :axios-form-post-url="'/serviceitems'"
        :axios-update-url="'../serviceitems/'"
        :redirect-url="'../vehicles/' + {{ $vehicleData->id }}"
        :rule-set="'addserviceitem'" 
        :delete-confirm-post-url="'/serviceitems/'"
        >
        <template v-slot:card-header>
            <div class="card-header">Service Log for {{ $vehicleData->year }} {{ $vehicleData->make }} {{ $vehicleData->model }}</div>
        </template>
        <template v-slot:return-link>
            <div><a href="/" class="link-secondary" title="Go back to vehicle list">Go back to vehicle list</a></div>
        </template>
</table-component>

@endsection