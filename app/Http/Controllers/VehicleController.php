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

    public function index(Request $request, Vehicle $vehicle)
    {
        $vehicle = $this->vehicle->forUserSingle($request->user(), $vehicle);
        $workOrders = WorkItems::where('vehicle_id', $vehicle->id)->orderBy('service_date', 'desc')->get();

        return view('vehicles.index', [
            'vehicle' => $vehicle,
            'workOrders' => $workOrders,
        ]);
    }
}
