@extends('layouts.app')

@section('content')

<table-component 
    :bootstrap-columns="'col-md-8'"
    :items="{{ $vehicles }}" 
    :table-name="'vehicles'" 
    :subdirectory1="'/serviceitems'"
    :columns="[
        {'name': 'year', 'css_classes': 'table-text'}, 
        {'name': 'make', 'css_classes': 'table-text'}, 
        {'name': 'model', 'css_classes': 'table-text'}]"
    :options="['view', 'delete']"
    :fields="[    
        {'name': 'year', 'type': 'number'},
        {'name': 'make', 'type': 'text'},
        {'name': 'model', 'type': 'text'}]"
    :hidden-fields="[]"
    :axios-create-url="'/vehicles/'"
    :axios-delete-url="'/vehicles/'"
    :redirect-url="'/'"
    :rule-set="'addvehicle'"
></table-component>

@endsection
