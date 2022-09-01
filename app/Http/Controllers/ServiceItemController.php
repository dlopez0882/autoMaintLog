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
    protected $ServiceItem;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ServiceItemRepository $ServiceItem)
    {
        $this->middleware('auth');

        $this->ServiceItem = $ServiceItem;
    }

    /**
     * Create a new work item.
     *
     * @param  Request  $request
     * @return void
     */
    public function store(Request $request)
    {        
        ServiceItem::create([
            'service_date' => $request->ServiceItemProps['date'],
            'vehicle_id' => $request->ServiceItemProps['vehicle_id'],
            'mileage' => $request->ServiceItemProps['mileage'],
            'service_summary' => $request->ServiceItemProps['service_summary'],
            'service_details' => $request->ServiceItemProps['service_details'],
            'technician' => $request->ServiceItemProps['technician'],
            'cost' => $request->ServiceItemProps['cost'],
        ]);
     
        return;
    }

    /**
     * Delete a work item.
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
     * Get a specific work item.
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
     * Update a specific work item.
     *
     * @param  Request  $request
     * @param  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        ServiceItem::where('id', $id)->update([
            'service_date' => $request->ServiceItemProps['date'],
            'mileage' => $request->ServiceItemProps['mileage'],
            'service_summary' => $request->ServiceItemProps['service_summary'],
            'service_details' => $request->ServiceItemProps['service_details'],
            'technician' => $request->ServiceItemProps['technician'],
            'cost' => $request->ServiceItemProps['cost'],
        ]);
     
        return;
    }
}
