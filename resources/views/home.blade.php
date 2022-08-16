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
                                        <a href="{{ url("vehicle/". $vehicle->id) }}" class="btn btn-primary"><i class="fa fa-gear"></i> See maintenance log</a>
                                    </td>
    
                                    <td>
                                        <!-- Delete record button -->
                                        {{-- <form action="{{ url("deletevehicle/" . $vehicle->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }} --}}
    
                                            {{-- <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i> Delete vehicle
                                            </button> --}}

                                            {{-- <button id="show-modal" class="btn btn-danger" @click="showModal = true, vehicle_id={{ $vehicle->id }}"><i class="fa fa-trash"></i> Delete vehicle</button> --}}
                                            <button id="show-modal" class="btn btn-danger" @click="showModal = true, vehicle={{ json_encode($vehicle) }}, postroute='{{ url("deletevehicle/" . $vehicle->id) }}' "><i class="fa fa-trash"></i> Delete vehicle</button>
                                            <!-- use the modal component -->

                                        {{-- </form> --}}
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
        <modal-component v-if="showModal" @close="showModal = false" v-bind:vehicle = vehicle v-bind:postroute = postroute>
          <!--
            you can use custom content here to overwrite
            default content
          -->
          <template v-slot:header>
            <h3>Confirm</h3>
          </template>
        </modal-component>
      </transition>

</div>
@endsection
