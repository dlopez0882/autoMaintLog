@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $vehicle->year . " " . $vehicle->make . " " . $vehicle->model }}</div>

                <!-- form for entering a maintenance record -->
                <div class="card-body">
                    <h2>Enter Work Item</h2>
                    <form action="">

                        <div class="mb-3">
                            <label for="date">Date</label>
                            <input type="date" name="date" id="date" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="mileage">Mileage</label>
                            <input type="number" name="mileage" id="mileage" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="services">Service item(s)</label>
                            <input type="text" name="services" id="services" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="technician">Performed by</label>
                            <input type="text" name="technician" id="technician" class="form-control" value="">
                        </div>
                        <div class="mb-3">
                            <label for="cost">Cost</label>
                            <input type="number" name="cost" id="cost" class="form-control" value="">
                        </div>

                        <!-- add work item button -->
                        <div class="mb-3">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Add Work Item
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>

                <!-- table of maintenance records -->
                <div class="card-body">
                    <h2>Work Items</h2>
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Date</th>
                            <th>Mileage</th>
                            <th>Service item(s)</th>
                            <th>Performed by</th>
                            <th>Cost</th>
                        </thead>

                        <tbody>
                            @foreach ($workOrders as $workOrder)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $workOrder->service_date }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $workOrder->mileage }}</div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        {{-- <ul>
                                            <li>Install OEM brake pads F (p/n: 45022-S2A-E51)</li>
                                            <li>Install OEM brake pads R (p/n: 43022-S2A-010)</li>
                                        </ul> --}}
                                        {{ $workOrder->services }}
                                    </div>
                                </td>
                                <td class="table-text">
                                    {{ $workOrder->technician_id }}
                                </td>
                                <td class="table-text">
                                    ${{ $workOrder->cost }}
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