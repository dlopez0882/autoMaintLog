@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add a New Vehicle</div>

                <!-- form for entering a maintenance record -->
                <div class="card-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                    <form action="{{ url('addvehicle') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        {{-- hidden field(s) --}}
                        {{-- <input type="hidden" name="vehicle_id" id="vehicle_id" value="{{ $vehicle->id }}"> --}}

                        <div class="mb-3">
                            <label for="mileage">Year</label>
                            <input type="number" name="year" id="mileyearage" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="services">Make</label>
                            <input type="text" name="make" id="make" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="technician">Model</label>
                            <input type="text" name="model" id="model" class="form-control" value="">
                        </div>

                        <!-- add work item button -->
                        <div class="mb-3">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Add Vehicle
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
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
                                        <a href="{{ url("vehicle/". $vehicle->id) }}" class="btn btn-primary"><i class="fa fa-gear"></i> See Maintenance Log</a>
                                    </td>
    
                                    <td>
                                        <!-- Button to open delete confirmation modal -->
                                        <button 
                                            id="show-modal" 
                                            class="btn btn-danger" 
                                            @click="showModal = true, vehicle={{ json_encode($vehicle) }}, postroute='{{ url("deletevehicle/" . $vehicle->id) }}'"
                                        >
                                        <i class="fa fa-trash"></i> Delete Vehicle</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <transition name="modal">
        <modal-component v-if="showModal" @close="showModal = false" v-bind:vehicledata = "{vehicle:vehicle, postroute:postroute}">
            <template v-slot:header>
                <h3>Confirm</h3>
            </template>
        </modal-component>
    </transition>

</div>


@endsection
