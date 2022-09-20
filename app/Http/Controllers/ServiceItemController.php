<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ServiceItemRepository;
use App\Repositories\VehicleRepository;
use App\Models\ServiceItem;
use App\Models\Vehicle;

class ServiceItemController extends Controller
{
    /**
     * The service item's repository instance.
     *
     * @var ServiceItemRepository
     */
    protected $serviceItem;

    /**
     * The vehicle's repository instance.
     *
     * @var VehicleRepository
     */
    protected $vehicle;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ServiceItemRepository $serviceItem, VehicleRepository $vehicle)
    {
        $this->middleware('auth');

        $this->serviceItem = $serviceItem;

        $this->vehicle = $vehicle;
    }

    /**
     * Show all services items for a specific vehicle.
     *
     * @return Response
     */
    public function index(Request $request, Vehicle $vehicle)
    {
        $vehicleData = $this->vehicle->forUserSingle($request->user(), $vehicle);
        $serviceItems = ServiceItem::where('vehicle_id', $vehicle->id)->orderBy('service_date', 'desc')->get();

        return view('serviceitems.index', [
            'vehicleData' => $vehicleData,
            'serviceItems' => $serviceItems
        ]);
    }

    /**
     * Create a service item.
     *
     * @param  Request  $request
     * @return void
     */
    public function store(Request $request)
    {        
        ServiceItem::create([
            'service_date' => $request->formData['service_date'],
            'vehicle_id' => $request->formData['vehicle_id'],
            'mileage' => $request->formData['mileage'],
            'service_summary' => $request->formData['service_summary'],
            'service_details' => $request->formData['service_details'],
            'technician' => $request->formData['technician'],
            'cost' => $request->formData['cost'],
        ]);
     
        return;
    }

    /**
     * Delete a service item.
     *
     * @param  Request  $request
     * @param  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {        
        /**
         * get vehicle from post request data
         * use dd($vehicle) to see post request data
        */ 
        $vehicleid = $request->vehicle_id; 

        // sql: DELETE FROM service_items WHERE id = $id;
        ServiceItem::where('id', $id)->delete();

        return redirect('/vehicles/' . $vehicleid . '/serviceitems');
    }

    /**
     * Get a specific service item.
     *
     * @param  $id
     * @return Response
     */
    public function show($id)
    {
        $data = ServiceItem::where('id', $id)->first();
        return $data;
    }

    /**
     * Update a specific service item.
     *
     * @param  Request  $request
     * @param  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        ServiceItem::where('id', $id)->update([
            'service_date' => $request->formData['service_date'],
            'mileage' => $request->formData['mileage'],
            'service_summary' => $request->formData['service_summary'],
            'service_details' => $request->formData['service_details'],
            'technician' => $request->formData['technician'],
            'cost' => $request->formData['cost'],
        ]);
     
        return;
    }
}
