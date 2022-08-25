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
            'services' => $request->workItemProps['services'],
            'technician' => $request->workItemProps['technician'],
            'cost' => $request->workItemProps['cost'],
        ]);
     
        return;
    }

    /**
     * Delete a work item.
     *
     * @param  Request  $request
     * @return void
     */
    public function destroy(Request $request)
    {        
     
        return;
    }
}
