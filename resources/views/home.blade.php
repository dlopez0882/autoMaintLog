@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Vehicles') }}</div>

                <div class="card-body">
                    @if($vehicles->count() == 0)
                    <div class="mb-2">No vehicles found!</div>
                    @else
                    <table class="table table-striped task-table">
                        {{-- Table Headings --}}
                        <thead>
                            <th>Vehicle</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>
    
                        {{-- Table Body --}}
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr>
                                    <td class="table-text">
                                        <div>{{ $vehicle->year . " " . $vehicle->make . " " . $vehicle->model }}</div>
                                    </td>
                                    
                                    <td>
                                        {{-- Show records button button --}}
                                        <a href="{{ url("vehicle/". $vehicle->id) }}" class="btn btn-primary" title="See Maintenance Log"><i class="fa fa-gear"></i> See Maintenance Log</a>
                                    </td>
    
                                    <td>
                                        {{-- Button to open delete confirmation modal --}}
                                        <button 
                                            id="show-modal" 
                                            class="btn btn-danger" 
                                            title="Delete Vehicle"
                                            @click="showModal = true, vehicle={{ json_encode($vehicle) }}, postroute='{{ url("deletevehicle/" . $vehicle->id) }}'"
                                            @keydown.esc="showModal = false" 
                                        >
                                        <i class="fa fa-trash"></i> Delete Vehicle</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                    
                    <button 
                        type="button"
                        id="show-add-vehicle-modal"
                        class="btn btn-primary"
                        title="Add Vehicle"
                        @click="showAddVehicleModal = true, postroute='{{ url("addvehicle") }}'"
                        @keydown.esc="showAddVehicleModal = false" 
                    >
                    <i class="fa fa-plus"></i> Add Vehicle</button>

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

    <transition name="modal">
        <add-vehicle-modal-component v-if="showAddVehicleModal" @close="showAddVehicleModal = false" v-bind:data = "{postroute:postroute}"></add-vehicle-modal-component>
    </transition>

</div>


@endsection
