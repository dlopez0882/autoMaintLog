@extends('layouts.app')

@section('content')

<!-- table of maintenance records -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Work Items for {{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }}</div>
                <div class="card-body">
                    <div><a href="{{ url('/') }}" class="link-secondary" title="Go Back to Vehicle List">Go Back to Vehicle List</a></div>

                    @if($workOrders->count() == 0)
                    <div class="mt-2 mb-2">No work items found!</div>
                    @else
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Date</th>
                            <th>Mileage</th>
                            <th>Service summary</th>
                            <th class="d-none d-md-table-cell">Performed by</th>
                            <th class="d-none d-md-table-cell">Cost</th>
                            <th>&nbsp;</th>
                        </thead>

                        <tbody>
                            @foreach ($workOrders as $workOrder)
                            <tr>
                                <td class="table-text">
                                    <div>
                                        <a href="#" title="See service details" 
                                        @click="showWorkItemDetailsModal = true, workItemID={{ $workOrder->id }}"
                                        >{{ $workOrder->service_date }}</a>
                                    </div>
                                </td>
                                <td class="table-text">
                                    <div>{{ number_format($workOrder->mileage) }}</div>
                                </td>
                                <td class="table-text">
                                    {{-- formatted to render html --}}
                                    <div>{!! $workOrder->service_summary !!}</div>
                                </td>
                                <td class="table-text d-none d-md-table-cell">
                                    {{ $workOrder->technician }}
                                </td>
                                <td class="table-text d-none d-md-table-cell">
                                    ${{ $workOrder->cost }}
                                </td>
                                <td>
                                    <a href="javascript:void(0)" title="Delete this work item"
                                    @click="showDeleteWorkItemConfirmModal = true, postroute='{{ url("deleteworkitem/" . $workOrder->id) }}', vehicleid={{ $vehicle->id }}, csrftoken='{{ csrf_token() }}'"
                                    ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif

                    <button 
                        type="button"
                        id="show-add-work-item-modal"
                        class="btn btn-primary"
                        title="Add Work Item"
                        @click="showAddWorkItemModal = true, postroute='{{ url("addworkitem") }}', vehicleid={{ $vehicle->id }}"
                    >
                    <i class="fa fa-plus"></i> Add Work Item</button>

                </div>
            </div>
        </div>
    </div>

    <transition name="modal">
        <add-work-item-modal-component v-if="showAddWorkItemModal" @close="showAddWorkItemModal = false" v-bind:data = "{postroute:postroute, vehicleid:vehicleid}"></add-work-item-modal-component>
    </transition>

    <transition name="modal">
        <delete-work-item-modal-component v-if="showDeleteWorkItemConfirmModal" @close="showDeleteWorkItemConfirmModal = false" v-bind:data = "{postroute:postroute, vehicleid:vehicleid, csrftoken:csrftoken}">
            <template v-slot:header>
                <h3>Confirm</h3>
            </template>
        </delete-work-item-modal-component>
    </transition>

    <transition name="modal">
        <work-item-details-modal-component v-if="showWorkItemDetailsModal" @close="showWorkItemDetailsModal = false" v-bind:data = "{workItemID:workItemID}"></work-item-details-modal-component>
    </transition>

</div>

@endsection