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
    :redirect-url="'/'"
    :rule-set="'addvehicle'"
></table-component>

@endsection
