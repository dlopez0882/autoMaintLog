@extends('layouts.app')

@section('content')

<table-component 
    :items="{{ $vehicles }}" 
    :table-name="'vehicles'" 
    :columns="['year', 'make', 'model']"
    :options="['view', 'delete']"
    :fields="[    
        {'name': 'year', 'type': 'number'},
        {'name': 'make', 'type': 'text'},
        {'name': 'model', 'type': 'text'}]"
    :hidden-fields="[]"
    :axios-post-url="'/vehicles'"
    :redirect-url="'/'"
    :rule-set="'addvehicle'"
></table-component>

@endsection
