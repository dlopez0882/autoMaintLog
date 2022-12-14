@extends('layouts.app')

@section('content')

<table-component
    :bootstrap-columns="'col-11'"
    :items="{{ $serviceItems }}"
    :table-name="'service_items'"
    {{-- :columns to be used for table column data --}}
    :columns="[
        {'name': 'service_date', 'css_classes': 'table-text'},
        {'name': 'mileage', 'format': 'number', 'css_classes': 'table-text'}, 
        {'name': 'service_summary', 'css_classes': 'table-text text-break'},
        {'name': 'technician', 'css_classes': 'table-text d-none d-md-table-cell'},
        {'name': 'cost', 'format': 'currency', 'css_classes': 'table-text d-none d-md-table-cell'}
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
    :axios-create-url="'/vehicles/' + {{ $vehicleData->id }} + '/serviceitems'"
    :axios-get-url="'/serviceitems/'"
    :axios-update-url="'/serviceitems/'"
    :axios-delete-url="'/serviceitems/'"
    :redirect-url="'/vehicles/' + {{ $vehicleData->id }} + '/serviceitems'"
    :rule-set="'addserviceitem'"
    :table-header="'Service Log for {{ $vehicleData->year }} {{ $vehicleData->make }} {{ $vehicleData->model }}'"
    >
    <template v-slot:breadcrumb>
        <b-breadcrumb :items="[
            {'text': 'My vehicles', 'href': '/vehicles'},
            {'text': 'Service log'}
        ]"
        ></b-breadcrumb>
    </template>
</table-component>

@endsection