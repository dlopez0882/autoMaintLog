<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\VehicleRepository;
use App\Models\Vehicle;
use App\Models\WorkItems;

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
     * Display a list of all of the user's vehicles.
     *
     * @param  Request  $request
     * @param  Vehicle  $vehicle
     * @return Response
     */
    public function index(Request $request, Vehicle $vehicle)
    {
        $vehicle = $this->vehicle->forUserSingle($request->user(), $vehicle);
        $workOrders = WorkItems::where('vehicle_id', $vehicle->id)->orderBy('service_date', 'desc')->get();

        return view('vehicles.index', [
            'vehicle' => $vehicle,
            'workOrders' => $workOrders,
        ]);
    }

    /**
     * Create a new vehicle record.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            '*' => 'required'
        ]);
    
        $request->user()->vehicles()->create([
            'year' => $request->year,
            'make' => $request->make,
            'model' => $request->model,
        ]);
     
        return redirect('/');
    }

    /**
     * Delete a vehicle and its associate maintenance history items.
     *
     * @param  Request  $request
     * @param  Vehicle  $vehicle
     * @param  WorkItems  $workItems  
     * @return Response
     */
    public function destroy(Request $request, Vehicle $vehicle, WorkItems $workItems)
    {
        $this->authorize('destroy', $vehicle);

        $vehicle->delete();
        $workItems->where('vehicle_id', $vehicle->id)->delete();

        return redirect('/');
    }
}
