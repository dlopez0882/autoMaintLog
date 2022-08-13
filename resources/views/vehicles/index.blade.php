@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $vehicle->year . " " . $vehicle->make . " " . $vehicle->model }}</div>

                <!-- body -->
                <div class="card-body">
                    <table class="table table-striped task-table">
                        <thead>
                            <th>Date</th>
                            <th>Mileage</th>
                            <th>Maintenance</th>
                            <th>Performed by</th>
                            <th>Cost</th>
                        </thead>

                        <tbody>
                            @foreach ($workOrders as $workOrder)
                            <tr>
                                <td class="table-text">
                                    <div>{{ $workOrder["date"] }}</div>
                                </td>
                                <td class="table-text">
                                    <div>{{ $workOrder["mileage"] }}</div>
                                </td>
                                <td class="table-text">
                                    <div>
                                        {{-- <ul>
                                            <li>Install OEM brake pads F (p/n: 45022-S2A-E51)</li>
                                            <li>Install OEM brake pads R (p/n: 43022-S2A-010)</li>
                                        </ul> --}}
                                        {{ $workOrder["work_items"] }}
                                    </div>
                                </td>
                                <td class="table-text">
                                    {{ $workOrder["performedBy"] }}
                                </td>
                                <td class="table-text">
                                    {{ $workOrder["cost"] }}
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