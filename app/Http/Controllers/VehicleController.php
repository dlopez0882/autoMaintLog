<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\VehicleRepository;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Storage;

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
        // only temporary until we can retrieve from DB...
        $workOrders = Storage::disk('public')->get('json/work_order.json');
        $workOrders = json_decode($workOrders, true);

        return view('vehicles.index', [
            'vehicle' => $this->vehicle->forUserSingle($request->user(), $vehicle),
            'workOrders' => $workOrders,
        ]);
    }
}
