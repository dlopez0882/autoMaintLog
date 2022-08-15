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
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            // 'mileage' => 'required|max:7',
            '*' => 'required',
        ]);
        
        WorkItems::create([
            'service_date' => $request->date,
            'vehicle_id' => $request->vehicle_id,
            'mileage' => $request->mileage,
            'services' => $request->services,
            'technician' => $request->technician,
            'cost' => $request->cost,
        ]);
     
        return redirect('vehicle/' . $request->vehicle_id);
    }
}