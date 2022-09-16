@extends('layouts.app')

@section('content')

{{-- table of maintenance records --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-11">
            <div class="card">
                <div class="card-header">Service Log for {{ $vehicleData->year }} {{ $vehicleData->make }} {{ $vehicleData->model }}</div>
                <div class="card-body">
                    <div><a href="{{ url('/') }}" class="link-secondary" title="Go back to vehicle list">Go back to vehicle list</a></div>

                    @if($workOrders->count() == 0)
                    <div class="mt-2 mb-2">No service log found!</div>
                    @else
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Date</th>
                            <th>Mileage</th>
                            <th>Service summary</th>
                            <th class="d-none d-md-table-cell">Performed by</th>
                            <th class="d-none d-md-table-cell">Cost</th>
                            <th>&nbsp;</th>
                            <th>&nbsp;</th>
                        </thead>

                        <tbody>
                            @foreach ($workOrders as $workOrder)
                            <tr>
                                <td class="table-text">
                                    <div>
                                        <a href="javascript:void(0)" title="See service log item details" 
                                        @click="showServiceItemDetailsModal = true, serviceItemID={{ $workOrder->id }}"
                                        @keydown.esc="showServiceItemDetailsModal = false" 
                                        >{{ $workOrder->service_date }}</a>
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>{{ number_format($workOrder->mileage) }}</div>
                                </td>
                                <td class="table-text">
                                    <div class="text-break">{{ $workOrder->service_summary }}</div>
                                </td>
                                <td class="table-text d-none d-md-table-cell">
                                    {{ $workOrder->technician }}
                                </td>
                                <td class="table-text d-none d-md-table-cell">
                                    ${{ $workOrder->cost }}
                                </td>
                                <td>
                                    <a href="javascript:void(0)" title="Edit this service log item"
                                    @click="showEditServiceItemModal = true, serviceItemID={{ $workOrder->id }}, vehicleid={{ $vehicleData->id }}"
                                    @keydown.esc="showEditServiceItemModal = false" 
                                    ><i class="fa fa-pencil"></i></a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" title="Delete this service log item"
                                    @click="showDeleteServiceItemConfirmModal = true, postroute='{{ url("/serviceitems/{$workOrder->id}") }}', vehicleid={{ $vehicleData->id }}, csrftoken='{{ csrf_token() }}'"
                                    @keydown.esc="showDeleteServiceItemConfirmModal = false" 
                                    ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif

                    <button 
                        type="button"
                        id="show-add-service-item-modal"
                        class="btn btn-primary"
                        title="Add Service Item"
                        @click="showAddServiceItemModal = true, postroute='{{ url("/serviceitems") }}', vehicleid={{ $vehicleData->id }}"
                        @keydown.esc="showAddServiceItemModal = false" 
                    >
                    <i class="fa fa-plus"></i> Add Service</button>

                </div>
            </div>
        </div>
    </div>

    <transition name="modal">
        <add-service-item-modal-component v-if="showAddServiceItemModal" @close="showAddServiceItemModal = false" v-bind:data = "{postroute:postroute, vehicleid:vehicleid}"></add-service-item-modal-component>
    </transition>

    <transition name="modal">
        <edit-service-item-modal-component v-if="showEditServiceItemModal" @close="showEditServiceItemModal = false" v-bind:data = "{serviceItemID:serviceItemID, vehicleid:vehicleid}"></edit-service-item-modal-component>
    </transition>

    <transition name="modal">
        <delete-service-item-modal-component v-if="showDeleteServiceItemConfirmModal" @close="showDeleteServiceItemConfirmModal = false" v-bind:data = "{postroute:postroute, vehicleid:vehicleid, csrftoken:csrftoken}">
            <template v-slot:header>
                <h3>Confirm</h3>
            </template>
        </delete-service-item-modal-component>
    </transition>

    <transition name="modal">
        <service-item-details-modal-component v-if="showServiceItemDetailsModal" @close="showServiceItemDetailsModal = false" v-bind:data = "{serviceItemID:serviceItemID}"></service-item-details-modal-component>
    </transition>

</div>

@endsection