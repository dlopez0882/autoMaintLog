<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\WorkItemRepository;
use App\Models\WorkItems;

class WorkItemController extends Controller
{
    /**
     * The vehicles repository instance.
     *
     * @var WorkItemRepository
     */
    protected $workItem;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(WorkItemRepository $workItem)
    {
        $this->middleware('auth');

        $this->workItem = $workItem;
    }

    /**
     * Create a new work item.
     *
     * @param  Request  $request
     * @return void
     */
    public function store(Request $request)
    {        
        WorkItems::create([
            'service_date' => $request->workItemProps['date'],
            'vehicle_id' => $request->workItemProps['vehicle_id'],
            'mileage' => $request->workItemProps['mileage'],
            'service_summary' => $request->workItemProps['service_summary'],
            'service_details' => $request->workItemProps['service_details'],
            'technician' => $request->workItemProps['technician'],
            'cost' => $request->workItemProps['cost'],
        ]);
     
        return;
    }

    /**
     * Delete a work item.
     *
     * @param  Request  $id
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

        // sql: DELETE FROM work_items WHERE id = $id;
        WorkItems::where('id', $id)->delete();

        return redirect('/vehicle/' . $vehicleid);
    }

    /**
     * Get a specific work item.
     *
     * @param  $id
     * @return Response
     */
    public function show($id)
    {
        $data = WorkItems::where('id', $id)->first();
        return $data;
    }
}
