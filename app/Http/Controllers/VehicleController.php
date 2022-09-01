<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\VehicleRepository;
use App\Models\Vehicle;
use App\Models\ServiceItem;

class VehicleController extends Controller
{
    /**
     * The vehicles repository instance.
     *
     * @var VehicleRepository
     */
    protected $vehicle;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VehicleRepository $vehicle)
    {
        $this->middleware('auth');

        $this->vehicle = $vehicle;
    }

    /**
     * Display vehicle-specific info page.
     *
     * @param  Request  $request
     * @param  Vehicle  $vehicle
     * @return Response
     */
    public function show(Request $request, Vehicle $vehicle)
    {
        $vehicleData = $this->vehicle->forUserSingle($request->user(), $vehicle);
        $workOrders = ServiceItem::where('vehicle_id', $vehicle->id)->orderBy('service_date', 'desc')->get();

        return view('vehicles.index', [
            'vehicleData' => $vehicleData,
            'workOrders' => $workOrders,
        ]);
    }

    /**
     * Create a new vehicle record.
     *
     * @param  Request  $request
     * @return void
     */
    public function store(Request $request)
    {
        $request->user()->vehicles()->create([
            'year' => $request->vehicleProps['year'],
            'make' => $request->vehicleProps['make'],
            'model' => $request->vehicleProps['model'],
        ]);
     
        return;
    }

    /**
     * Delete a vehicle and its associate maintenance history items.
     *
     * @param  Request  $request
     * @param  Vehicle  $vehicle
     * @param  ServiceItem  $serviceItem  
     * @return Response
     */
    public function destroy(Request $request, Vehicle $vehicle, ServiceItem $serviceItem)
    {
        $this->authorize('destroy', $vehicle);

        $vehicle->delete();
        $serviceItem->where('vehicle_id', $vehicle->id)->delete();

        return redirect('/');
    }
}
