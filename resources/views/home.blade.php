@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Vehicles') }}</div>

                <div class="card-body">
                    <table class="table table-striped task-table">
                        <!-- Table Headings -->
                        <thead>
                            <th>Vehicle</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>
    
                        <!-- Table Body -->
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ $vehicle->year . " " . $vehicle->make . " " . $vehicle->model }}</div>
                                    </td>
                                    
                                    <td>
                                        <!-- Show records button button -->
                                        <a href="{{ url("vehicle/". $vehicle->id) }}" class="btn btn-primary"><i class="fa fa-gear"></i> See maitenance log</a>
                                    </td>
    
                                    <td>
                                        <!-- Delete record button -->
                                        <form action="{{ url("/home") }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
    
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i> Delete vehicle
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
