<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ServiceItemRepository;
use App\Models\ServiceItem;

class ServiceItemController extends Controller
{
    /**
     * The vehicles repository instance.
     *
     * @var ServiceItemRepository
     */
    protected $serviceItem;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ServiceItemRepository $serviceItem)
    {
        $this->middleware('auth');

        $this->serviceItem = $serviceItem;
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
            'service_date' => $request->serviceItemProps['date'],
            'vehicle_id' => $request->serviceItemProps['vehicle_id'],
            'mileage' => $request->serviceItemProps['mileage'],
            'service_summary' => $request->serviceItemProps['service_summary'],
            'service_details' => $request->serviceItemProps['service_details'],
            'technician' => $request->serviceItemProps['technician'],
            'cost' => $request->serviceItemProps['cost'],
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
        $vehicleid = $request->vehicleid; 

        // sql: DELETE FROM service_items WHERE id = $id;
        ServiceItem::where('id', $id)->delete();

        return redirect('/vehicles/' . $vehicleid);
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
            'service_date' => $request->serviceItemProps['date'],
            'mileage' => $request->serviceItemProps['mileage'],
            'service_summary' => $request->serviceItemProps['service_summary'],
            'service_details' => $request->serviceItemProps['service_details'],
            'technician' => $request->serviceItemProps['technician'],
            'cost' => $request->serviceItemProps['cost'],
        ]);
     
        return;
    }
}
