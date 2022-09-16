@extends('layouts.app')

@section('content')

<table-component 
    :items="{{ $vehicles }}" 
    :table-name="'vehicles'" 
    :columns="[
        {'name': 'year'}, 
        {'name': 'make'}, 
        {'name': 'model'}]"
    :options="['view', 'delete']"
    :fields="[    
        {'name': 'year', 'type': 'number'},
        {'name': 'make', 'type': 'text'},
        {'name': 'model', 'type': 'text'}]"
    :hidden-fields="[]"
    :axios-form-post-url="'/vehicles'"
    :redirect-url="'/'"
    :rule-set="'addvehicle'"
    :delete-confirm-post-url="'/vehicles/'"
></table-component>

@endsection
