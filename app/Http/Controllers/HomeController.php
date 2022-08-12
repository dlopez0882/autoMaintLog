<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\VehicleRepository;
use App\Models\Vehicle;

class HomeController extends Controller
{
    /**
     * The vehicles repository instance.
     *
     * @var VehicleRepository
     */
    protected $vehicles;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(VehicleRepository $vehicles)
    {
        $this->middleware('auth');

        $this->vehicles = $vehicles;
    }

    /**
     * Show the application dashboard of user's current vehicles.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $vehicles = $request->user()->vehicles()->get();

        return view('home', [
            'vehicles' => $this->vehicles->forUser($request->user()),
        ]);
    }
}
